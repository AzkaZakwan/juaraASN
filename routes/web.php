<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/tryout', function () {
    return view('tryout.tryout');
})->name('tryout');
Route::get('/tryout/starts', function () {
    return view('tryout.starts');
})->name('starts');
Route::get('/tryout/prepare', function () {
    return view('tryout.prepare');
})->name('prepare');
Route::get('/loginASN', function () {
    return view('auth.loginASN');
})->name('login');
Route::get('/signupASN', function () {
    return view('auth.signupASN');
})->name('signup');