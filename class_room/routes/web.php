<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TopicsController;
use App\Models\Classroom;
use App\Models\Topic;
use PHPUnit\Framework\Attributes\Group;
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


Route::group(
    [
        'prefix' => 'topics/',
        'as' => 'topics.',
        'controller' => TopicsController::class,

    ],
    function () {
        Route::get('trashed', 'trashed')
            ->name('trashed');

        Route::put('trashed/{classroom}',  'restore')
            ->name('restore');

        Route::delete('trashed/{classroom}',  'forceDelete')
            ->name('forceDelete');

        Route::get('create/{classroom}' ,'create')
            ->name('create');

        Route::post('/{classroom}',  'store')
            ->name('store');

        Route::get('edit/{topic}', 'edit')
            ->name('edit');

        Route::put('{topic}',  'update')
            ->name('update');

        Route::delete('{topic}', 'destroy')
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'classrooms/',
        'as' => 'classroom.',
        'controller' => ClassroomsController::class,
        'middleware' => 'auth'
    ],
    function () {
        Route::get('trashed', 'trashed')
            ->name('trashed');

        Route::put('trashed/{classroom}',  'restore')
            ->name('restore');

        Route::delete('trashed/{classroom}',  'forceDelete')
            ->name('forceDelete');

        Route::get('/', 'index')
            ->name('index');

        Route::get('create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('{classroom}/',  'show')
            ->name('show');
        // ->where('classroom', '[0-9]+');

        Route::get('edit/{classroom}',  'edit')
            ->name('edit');

        Route::patch('{classroom}', 'update')
            ->name('update');

        Route::delete('delete/{classroom}', 'destroy')
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'classrooms/',
        'as' => 'classroom.',
        'controller' => JoinClassroomController::class,
        'middleware' => 'auth'
    ],
    function () {
        Route::get('{classroom}/join' , 'create')
        ->middleware('signed')
        ->name('join');

        Route::post('{classroom}/join' ,'store');
    }
);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
