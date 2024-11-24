<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/dashboard', 'googleAuthentication')->name('auth.google.dashboard');

    Route::get('/auth/github', 'loginWithGithub')->name('github.login');
    Route::get('/auth/github_login', 'githubAuthentication')->name('github.github_login.dashboard');
});




Route::view('/', 'posts.index')->name('home');
Route::resource('/post', PostController::class);

// grouping  route using middleware{guest and authenticated}
Route::middleware('guest')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/about', 'products.about')->name('about');
    Route::view('/blog', 'products.blog')->name('blog');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'users.dashboard')->name('dashboard');
    Route::view('/explore', 'products.explore')->name('explore');
    Route::view('/support', 'products.support')->name('support');
});





// Route::get('/dashboard', [DashboardController::class, 'index']);