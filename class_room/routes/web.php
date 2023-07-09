<?php

use App\Http\Controllers\ClassroomsController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/classrooms', [ClassroomsController::class, 'index'])
    ->name('classrooms.index');
Route::get('/classrooms/create', [ClassroomsController::class, 'create'])
    ->name('classrooms.create');
Route::get('/classrooms/{classroom}/', [ClassroomsController::class, 'show'])
    ->name('classrooms.show')
    ->where('classroom', '[0-9]+');
Route::get('classrooms/edit/{id}', [ClassroomsController::class, 'edit'])
    ->name('classrooms.edit');
