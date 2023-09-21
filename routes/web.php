<?php

use App\Http\Controllers\Admin\TowFactorAuthenticationController;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\Classroom;
use App\Models\Submission;
use App\Http\Controllers\Webhooks;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\Webhooks\StripeController;
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

Route::get('/admin/2fa', [TowFactorAuthenticationController::class, 'create']);
Route::get('plans', [PlanController::class, 'index'])->name('plans');
Route::post('/payments/stripe/webhook', StripeController::class);

Route::middleware('auth:admin,web')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::post('subscriptions', [SubscriptionsController::class, 'store'])->name('subscriptions.store');
    Route::get('subscriptions/{subscription}/pay', [PaymentController::class, 'create'])->name('checkout');

    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');

    Route::get('payments/{subscription}/success', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('payments/{subscription}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancle');

    Route::group(
        [
            'prefix' => 'topics/',
            'as' => 'topics.',
            'controller' => TopicsController::class,

        ],
        function () {
            Route::get('all/{classroom}', 'index')
                ->name('index');

            Route::get('{topic}', 'show')
                ->name('show');

            Route::get('create/{classroom}', 'create')
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

    Route::get('/classrooms/{classroom}/people',  [ClassroomPeopleController::class, 'index'])
        ->name('classroom.people');

    Route::delete('/classrooms/{classroom}/people',  [ClassroomPeopleController::class, 'destroy'])
        ->name('classroom.people.destroy');


    Route::post('comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::put('comments/{comment}', [CommentController::class, 'update'])
        ->name('comments.update');

    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    Route::get('post/show/{post}', [PostController::class, 'show'])
        ->name('posts.show');

    Route::post('posts/{classroom}/', [PostController::class, 'store'])
        ->name('posts.store');

    Route::put('posts/{post}/', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('destroy/{classroom}/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    Route::group(
        [
            'prefix' => 'classrooms/',
            'as' => 'classroom.',
            'controller' => ClassroomsController::class,
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

            Route::get('{classroom}/chat', 'chat')->name('chat');

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
        ],
        function () {
            Route::get('{classroom}/join', 'create')
                ->middleware('signed')
                ->name('join');

            Route::post('{classroom}/join', 'store');
        }
    );

    Route::post('subscriptions', [SubscriptionsController::class, 'store'])->name('subscriptions.store');

    Route::post('classworks/{classwork}/submissions', [SubmissionController::class,  'store'])
        ->name('submissions.store');

    Route::get('submissions/{submission}/file', [SubmissionController::class, 'file'])
        ->name('submission.file');


    Route::resource('classrooms.classworks', ClassworkController::class);

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group([
        'as' => 'profile.',
        'prefix' => 'profile'
    ], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// require __DIR__ . '/auth.php';
