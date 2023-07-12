<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\TopicsController;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(
    [
        'prefix' => 'topics/',
        'as' => 'topics.',
    ],
    function () {
        Route::get('create/{id}', [TopicsController::class, 'create'])
            ->name('create');

        Route::post('{id}', [TopicsController::class, 'store'])
            ->name('store');

        Route::get('edit/{id}', [TopicsController::class, 'edit'])
            ->name('edit');

        Route::put('{id}', [TopicsController::class, 'update'])
            ->name('update');

        Route::delete('{id}', [TopicsController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'classrooms/',
        'as' => 'classroom.',
    ],
    function () {
        Route::get('/', [ClassroomsController::class, 'index'])
            ->name('index');

        Route::get('create', [ClassroomsController::class, 'create'])
            ->name('create');

        Route::post('/', [ClassroomsController::class, 'store'])
            ->name('store');

        Route::get('{classroom}/', [ClassroomsController::class, 'show'])
            ->name('show')
            ->where('classroom', '[0-9]+');

        Route::get('edit/{id}', [ClassroomsController::class, 'edit'])
            ->name('edit');

        Route::patch('{id}', [ClassroomsController::class, 'update'])
            ->name('update');

        Route::delete('delete/{id}', [ClassroomsController::class, 'destroy'])
            ->name('destroy');
    }
);
