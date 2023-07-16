<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\TopicsController;
use App\Models\Classroom;
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
        Route::get('create/{classroom}', [TopicsController::class, 'create'])
            ->name('create');

        Route::post('/{classroom}', [TopicsController::class, 'store'])
            ->name('store');

        Route::get('edit/{topic}', [TopicsController::class, 'edit'])
            ->name('edit');

        Route::put('{topic}', [TopicsController::class, 'update'])
            ->name('update');

        Route::delete('{topic}', [TopicsController::class, 'destroy'])
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
            ->name('show');
            // ->where('classroom', '[0-9]+');

        Route::get('edit/{classroom}', [ClassroomsController::class, 'edit'])
            ->name('edit');

        Route::patch('{classroom}', [ClassroomsController::class, 'update'])
            ->name('update');

        Route::delete('delete/{classroom}', [ClassroomsController::class, 'destroy'])
            ->name('destroy');
    }
);

// This will define all route from the given controller
// Route::resource('/classrooms', ClassroomsController::class)
//     ->names([
//         'index' => 'classroom.index',
//     ]);


// we can define more than one resource at same function 
// Route::resources([
//     'topics' => TopicsController::class ,
//     'classrooms' => ClassroomsController::class,
// ]);
