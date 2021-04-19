<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VotesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//     ]);
// });

Route::get('/login', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'canResetPassword' => Route::has('password.request')
    ]);
})->name('login')->middleware('guest');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    //Users
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    //Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //Nominees
    Route::get('/nominees', [NomineeController::class, 'index'])->name('nominees');
    Route::post('/nominees', [NomineeController::class, 'store'])->name('nominees.store');
    Route::get('/nominees/create', [NomineeController::class, 'create'])->name('nominees.create');
    Route::get('/nominees/edit/{id}', [NomineeController::class, 'edit'])->name('nominees.edit');
    Route::put('/nominees/{nominee}', [NomineeController::class, 'update'])->name('nominees.update');
    Route::delete('/nominees/{nominee}', [NomineeController::class, 'destroy'])->name('nominees.destroy');

    //Votes
    Route::get('/votes', [VotesController::class, 'index'])->name('votes');
    Route::post('/votes', [VotesController::class, 'store'])->name('votes.store');
});
