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
    Route::view('/dashboard', 'admin.user.dashboard')->name('dashboard');
});

// Admin Routes (Protected by 'admin' middleware)


Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard - Uncomment and use this route for the admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manage Store (admin only)
    Route::view('/admin/store/index', 'admin.store.index')->name('manage.questions'); // Admin view for managing stores/questions
    Route::get('/admin/store/create', [UserController::class, 'addStoreForm'])->name('store.create'); // Create new store/resource form

    // User Management Routes (Admin only)
    Route::get('/admin/user/index', [UserController::class, 'loadAllUser'])->name('user_detail');  // Show all users
    Route::get('/admin/user/create', [UserController::class, 'addUserForm'])->name('addUserForm'); // Show form to create new user
    Route::post('/admin/user/create', [UserController::class, 'AddUser'])->name('user.create'); // Store new user

    // Edit User
    Route::get('/admin/user/edit/{id}', [UserController::class, 'editUserForm'])->name('editUserForm'); // Edit user form
    Route::post('/admin/user/edit/{id}', [UserController::class, 'update'])->name('user.edit'); // Update user data

    // Delete User
    Route::post('/admin/user/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser'); // Delete a user
});




// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});
