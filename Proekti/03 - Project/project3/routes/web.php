<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminMoviesController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

// Button register form route
Route::get('/regform', function () {
    return view('regform');
})->name('regform');

// Choose plan route
Route::get('/choose-plan', function () {
    return view('choose-plan');
})->name('choose-plan');

// Payment routes
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

// Credit or Debit option route
Route::get('/creditoption', function () {
    return view('creditoption');
})->name('creditoption');

// Browse movies route
Route::get('/movies', [MovieController::class, 'index'])->name('moviebrowse');

// Show movie details route
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('show');


// USER LOGIN

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




// Admin login route
Route::get('/adminlogin', function () {
    return view('adminlogin');
})->name('adminlogin');

Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->name('admin.dashboard');

Route::get('/admin/dashboard', [AdminMoviesController::class, 'index'])->name('admin.dashboard');

// Route to show the login form
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Route to handle the login form submission
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::post('/admin/movies', [AdminMoviesController::class, 'store'])->name('admin.movies.store');


Route::prefix('admin')->group(function () {
    Route::post('/movies', [AdminMoviesController::class, 'store'])->name('admin.movies.store');
    Route::get('/movies/{id}/edit', [AdminMoviesController::class, 'edit'])->name('admin.movies.edit');
    Route::put('/movies/{id}', [AdminMoviesController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{id}', [AdminMoviesController::class, 'destroy'])->name('admin.movies.destroy');
    Route::put('/admin/movies/{id}', [AdminMoviesController::class, 'update'])->name('admin.movies.update');
});

Route::post('/movies/{id}/rate', [RatingController::class, 'rate'])->name('movies.rate');
Route::post('/movies/{id}/rate', [MovieController::class, 'rate'])->name('movies.rate')->middleware('auth');
Route::post('/movies/{id}/comment', [MovieController::class, 'comment'])->name('movies.comment');

Route::delete('/comments/{id}', [MovieController::class, 'deleteComment'])->name('comments.delete');

