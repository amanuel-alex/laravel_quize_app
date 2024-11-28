<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Role Selection and Authentication Routes
Route::get('/select-role', [AuthController::class, 'showRoleSelectionForm'])->name('role.selection');
Route::get('/role/{role}/login', [AuthController::class, 'showLoginForm'])->name('role.login');
Route::get('/role/{role}/register', [AuthController::class, 'showRegisterForm'])->name('role.register');
// Admin Registration Routes
Route::view('/admin/register', 'auth.adminAuth.register')->name('adminRegister');
Route::post('/admin/register', [AuthController::class, 'adminregister']);

Route::view('/admin/login', 'auth.adminAuth.login')->name('adminLogin');
Route::post('/admin/login', [AuthController::class, 'adminlogin']);



// Google, GitHub, and Social Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('auth.google'); // Google login
    Route::get('/auth/dashboard', 'googleAuthentication')->name('auth.google.dashboard');

    Route::get('/auth/github', 'loginWithGithub')->name('github.login'); // GitHub login
    Route::get('/auth/github_login', 'githubAuthentication')->name('github.github_login.dashboard');

    // Uncomment for Facebook login if needed
    // Route::get('/auth/facebook', 'loginWithFacebook')->name('facebook.login');
    // Route::get('/auth/facebook_login', 'facebookAuthentication')->name('facebook.facebook_login.dashboard');
});


Route::redirect('/', 'posts'); // Redirect root to posts
Route::resource('/post', PostController::class); // Resource routes for posts 

// Guest Routes (For users not logged in)
Route::middleware('web')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/about', 'products.about')->name('about');
    Route::view('/blog', 'products.blog')->name('blog');
    Route::view('/references', 'products.references')->name('references');
    Route::view('/quize', 'products.quize')->name('quize');
    //Registration and Login routes
    Route::view('/register', 'auth.userAuth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.userAuth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (For users logged in)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/explore', 'products.explore')->name('explore');
    Route::view('/support', 'products.support')->name('support');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

// Admin Routes (Protected by 'admin' middleware)
Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Admin Store Management
    Route::view('/admin/store/index', 'admin.store.index')->name('manage.questions');
    Route::get('/admin/store/create', [UserController::class, 'addStoreForm'])->name('store.create');
    // User CRUD (Admin only)
    Route::get('/admin/user/index', [UserController::class, 'loadAllUser'])->name('user_detail'); // Show all users
    Route::get('/admin/user/index/create', [UserController::class, 'addUserForm'])->name('addUserForm'); // Create new user form
    Route::post('/admin/user/index/create', [UserController::class, 'AddUser'])->name('user.create'); // Create new user

    // Edit user routes
    Route::get('/admin/user/index/edit/{id}', [UserController::class, 'editUserForm'])->name('editUserForm'); // Edit user form
    Route::post('/admin/user/index/edit/{id}', [UserController::class, 'update'])->name('user.edit'); // Update user

    // Delete user route
    Route::post('/admin/user/index/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser'); // Delete user
});
// User Dashboard Routes
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard'); // User Dashboard
