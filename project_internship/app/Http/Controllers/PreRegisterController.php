<?php
// app/Http/Controllers/PreRegisterController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreRegistered;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;

class PreRegisterController extends Controller
{
    public function sendVerificationLink(Request $request)
    {
        // Rate limiting: max 3 requests per minute per IP
        $key = 'pre-register:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return response()->json([
                'message' => 'Too many verification requests. Please try again later.'
            ], 429); // Too Many Requests
        }

        RateLimiter::hit($key, 60); // 60 seconds decay

        // Validate email
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;

        // Check if the user already exists and is verified
        $record = PreRegistered::where('email', $email)->first();

        if ($record && $record->email_status === 'verified') {
            return response()->json([
                'message' => 'Email is already verified.'
            ], 409); // Conflict
        }

        // Generate a random verification token (32 characters)
        $token = Str::random(32);
        
        // Hash the token before storing
        $hashedToken = Hash::make($token);

        // Store or update record in pre_registered table
        $record = PreRegistered::updateOrCreate(
            ['email' => $email],
            [
                'verification_code' => $hashedToken,
                'email_status' => 'unverified',
                'verification_expires_at' => Carbon::now()->addMinutes(15),
            ]
        );

        // Generate verification link
        $verificationLink = route('verify-email', [
            'token' => $token,
            'email' => urlencode($email)
        ]);

        // Send verification email
        try {
            Mail::to($email)->send(new VerificationMail($verificationLink));
            
            return response()->json([
                'message' => 'Verification link sent successfully! Please check your email.',
                'email' => $email
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Verification email failed: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to send verification email. Please try again.'
            ], 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        // Validate input
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email'
        ]);

        $token = $request->token;
        $email = $request->email;

        // Find the record
        $record = PreRegistered::where('email', $email)->first();

        if (!$record) {
            return response()->json([
                'message' => 'Invalid verification link.'
            ], 404);
        }

        // Check if already verified
        if ($record->email_status === 'verified') {
            return response()->json([
                'message' => 'Email is already verified.'
            ], 409);
        }

        // Check if token has expired
        if (Carbon::now()->isAfter($record->verification_expires_at)) {
            return response()->json([
                'message' => 'Verification link has expired. Please request a new one.'
            ], 410); // Gone
        }

        // Verify the token using Hash
        if (!Hash::check($token, $record->verification_code)) {
            return response()->json([
                'message' => 'Invalid verification link.'
            ], 400);
        }

        // Mark as verified
        $record->update([
            'email_status' => 'verified',
            'verified_at' => Carbon::now()
        ]);

        \Log::info("Email verified: {$email}");

        return response()->json([
            'message' => 'Email verified successfully! You can now proceed with registration.'
        ], 200);
    }

    public function resendVerificationLink(Request $request)
    {
        // Rate limiting: max 2 resend requests per 10 minutes per IP
        $key = 'resend-verification:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 2)) {
            return response()->json([
                'message' => 'Too many resend requests. Please try again in 10 minutes.'
            ], 429);
        }

        RateLimiter::hit($key, 600); // 600 seconds (10 minutes) decay

        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;
        $record = PreRegistered::where('email', $email)->first();

        if (!$record) {
            // Don't reveal if email exists for security
            return response()->json([
                'message' => 'If this email exists, a verification link will be sent.'
            ], 200);
        }

        if ($record->email_status === 'verified') {
            return response()->json([
                'message' => 'This email is already verified.'
            ], 409);
        }

        // Generate new token
        $token = Str::random(32);
        $hashedToken = Hash::make($token);

        $record->update([
            'verification_code' => $hashedToken,
            'verification_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        $verificationLink = route('verify-email', [
            'token' => $token,
            'email' => urlencode($email)
        ]);

        try {
            Mail::to($email)->send(new VerificationMail($verificationLink));
            
            return response()->json([
                'message' => 'Verification link sent successfully!'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Resend verification email failed: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to send verification email. Please try again.'
            ], 500);
        }
    }
}