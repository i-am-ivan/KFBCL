<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('signin');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/forgotPassword', function () {
    return view('forgotPassword');
})->name('forgotPassword');

Route::get('/resetPassword', function () {
    return view('resetPassword');
})->name('resetPassword');
