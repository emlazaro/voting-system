<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

//Send OTP

Route::post('/otp/send', [UsersController::class, 'sendOTP'])->name('otp.send');
