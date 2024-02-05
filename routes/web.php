<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('users',[UsersController::class, 'index'])->name('user-index');
Route::get('add-user',[UsersController::class, 'create'])->name('user-create');
Route::post('add-user',[UsersController::class, 'store'])->name('user-store');
