<?php

use App\Http\Controllers\FuncionDelSito;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FuncionDelSito::class, 'index'])->name('index');
Route::get('/about', [FuncionDelSito::class, 'about'])->name('about');
Route::get('/post', [FuncionDelSito::class, 'post'])->name('post');
Route::get('/contact', [FuncionDelSito::class, 'contact'])->name('contact');