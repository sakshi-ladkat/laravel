<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreRegisterController;

Route::get('/', function () {
    return view('welcome');
});

