<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('home');

Route::get('/team', function () {})->name('team');

Route::get('/login', function () {
  return view('login');
})->name('login');

Route::post('/login', function () {
  request()->validate([
    'email' => 'required|email',
    'password' => 'required',
  ]);

  $authenticated = Auth::attempt([
    'email' => request('email'),
    'password' => request('password'),
  ]);

  if (!$authenticated) {
    return back()->with([
      'error' => 'The provided credentials do not match our records.',
    ]);
  }

  return redirect()->route('home');
})->name('login.store');

Route::delete('/logout', function () {
  Auth::logout();
  return redirect()->route('home');
})->name('logout');
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

  Route::get('/profile', function () {
    $languages = [
      'en' => [
        'name' => 'English',
        'flag' => 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png'
      ],
      'es' => [
        'name' => 'Spanish',
        'flag' => 'https://www.countryflags.com/wp-content/uploads/spain-flag-png-large.png'
      ],
      'br' => [
        'name' => 'Portuguese',
        'flag' => 'https://www.countryflags.com/wp-content/uploads/brazil-flag-png-large.png'
      ],
    ];
    return view('dashboard.profile', compact('languages'));
  })->name('profile');
});
