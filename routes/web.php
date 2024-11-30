<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
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
});

// Redirect root to posts
Route::redirect('/', 'posts');
Route::resource('/post', PostController::class); // Resource routes for posts 

// Guest Routes (For users not logged in)
Route::middleware('web')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/about', 'products.about')->name('about');
    Route::view('/blog', 'products.blog')->name('blog');
    Route::view('/references', 'products.references')->name('references');
    // Route::view('/quize', [QuizController::class, 'getQuestions'])->name('quize');
    // Route::view('/quize', [QuizController::class, 'saveQuestionsToJson'])->name('quize');

    Route::get('/quize', [QuizController::class, 'showQuizPage'])->name('quize');

    // Route to fetch questions from the JSON file
    Route::get('/api/questions', [QuizController::class, 'getQuestions']);

    Route::view('/support', 'products.support')->name('support');
    // Registration and Login routes
    Route::view('/register', 'auth.userAuth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.userAuth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::get('/save-questions-to-json', [QuizController::class, 'saveQuestionsToJson']);

// Admin Routes (Protected by 'auth' and 'admin' middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::view('/admin/store/index', 'admin.store.index')->name('manage.questions');
    Route::get('/admin/store/create', [UserController::class, 'addStoreForm'])->name('store.create');
    Route::get('/admin/user/index', [UserController::class, 'loadAllUser'])->name('user_detail');
    Route::get('/admin/user/create', [UserController::class, 'addUserForm'])->name('addUserForm');
    Route::post('/admin/user/create', [UserController::class, 'AddUser'])->name('user.create');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'editUserForm'])->name('editUserForm');
    Route::post('/admin/user/edit/{id}', [UserController::class, 'update'])->name('user.edit');
    Route::post('/admin/user/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::view('/explore', 'products.explore')->name('explore');

    Route::get('/admin-dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
