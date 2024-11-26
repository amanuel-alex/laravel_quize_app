<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\FileUploadController;

Route::controller(AuthController::class)->group(function () {
    // LOGIN WITH GOOGLE
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/dashboard', 'googleAuthentication')->name('auth.google.dashboard');
    // LOGIN WITH GITHUB
    Route::get('/auth/github', 'loginWithGithub')->name('github.login');
    Route::get('/auth/github_login', 'githubAuthentication')->name('github.github_login.dashboard');
    // LOGIN WITH FACEBOOK
    // Route::get('/auth/facebook', 'loginWithfacebook')->name('facebook.login');
    // Route::get('/auth/facebook_login', 'facebookAuthentication')->name('facebook.facebook_login.dashboard');
});
// post route implementation
Route::redirect('/', 'posts');
Route::resource('/post', PostController::class);

// grouping  route using middleware{guest and authenticated}
Route::middleware('web')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/about', 'products.about')->name('about');
    Route::view('/blog', 'products.blog')->name('blog');
    Route::view('/references', 'products.references')->name('references');
    Route::view('/quize', 'products.quize')->name('quize');
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



// Admin dashboard and features
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    // Questions Routes
    Route::prefix('questions')->name('admin.questions.')->group(function () {
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/store', [QuestionController::class, 'store'])->name('store');
    });

    // Users Routes
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });

    // Recommendations Routes
    Route::prefix('recommendations')->name('admin.recommendations.')->group(function () {
        Route::get('/', [RecommendationController::class, 'index'])->name('index');
        Route::post('/send', [RecommendationController::class, 'send'])->name('send');
    });

    // File Upload Routes
    Route::prefix('upload')->name('admin.upload.')->group(function () {
        Route::get('/', [FileUploadController::class, 'index'])->name('index');
        Route::post('/store', [FileUploadController::class, 'store'])->name('store');
    });
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
