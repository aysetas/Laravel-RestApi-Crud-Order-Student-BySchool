<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [SchoolController::class, 'index'])
    ->name('anasayfa');

Route::resource('school', SchoolController::class)
    ->name('*', 'school');

Route::resource('student', StudentController::class)
    ->name('*', 'student');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
