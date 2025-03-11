<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  Auth::loginUsingId(1);
  return view('home');
})->name('home');

Route::get('/team', function () {})->name('team');
Route::get('/projects', function () {})->name('projects');
Route::get('/calendar', function () {})->name('calendar');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
  Route::get('/', function () {
    return view('dashboard.index'); // resources/views/dashboard/index.blade.php
  })->name('dashboard');

  Route::get('/users', function () {
    return view('dashboard.users'); // resources/views/dashboard/index.blade.php
  })->name('users');

  Route::get('/posts', function () {
    return view('dashboard.posts'); // resources/views/dashboard/index.blade.php
  })->name('posts');
});
