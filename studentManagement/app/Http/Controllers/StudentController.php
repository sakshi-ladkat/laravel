<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return 'hello from controller';
    }

    public function about()
    {
        return 'code with sakshi';
    }
}
