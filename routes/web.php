<?php

use App\Http\Controllers\PupilController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PupilParentController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BirthdayController;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth.login');
});

// Users area
Route::group(['middleware'=>'auth'], function(){
    // results
    Route::get('/results', [ResultController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('results');
    Route::get('/add-result', [ResultController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-result');
    Route::post('/create-result', [ResultController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-result');
    Route::get('/edit-result/{result}', [ResultController::class, 'edit'])
                    ->middleware('auth')
                    ->name('edit-result');
    Route::post('/update-result/{result}', [ResultController::class, 'update'])
                    ->middleware('auth')
                    ->name('update-result');
    Route::post('/delete-result/{result}', [ResultController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('delete-result');

    // homeworks
    Route::get('/homeworks', [HomeworkController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('homeworks');
    Route::get('/add-homework', [HomeworkController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-homework');
    Route::post('/create-homework', [HomeworkController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-homework');
    Route::get('/edit-homework/{homework}', [HomeworkController::class, 'edit'])
                    ->middleware('auth')
                    ->name('edit-homework');
    Route::post('/update-homework/{homework}', [HomeworkController::class, 'update'])
                    ->middleware('auth')
                    ->name('update-homework');
    Route::post('/delete-homework/{homework}', [HomeworkController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('delete-homework');

    // messages
    Route::get('/messages', [MessageController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('messages');
    Route::get('/add-message', [MessageController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-message');
    Route::post('/create-message', [MessageController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-message');
    Route::get('/view-message/{message}', [MessageController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-message');
    // Route::get('/edit-message/{message}', [MessageController::class, 'edit'])
    //                 ->middleware('auth')
    //                 ->name('edit-message');
    // Route::post('/update-message/{message}', [MessageController::class, 'update'])
    //                 ->middleware('auth')
    //                 ->name('update-message');
    // Route::post('/delete-message/{message}', [MessageController::class, 'destroy'])
    //                 ->middleware('auth')
    //                 ->name('delete-message');


    // birthdays
    Route::get('/birthdays', [BirthdayController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('birthdays');
    Route::get('/add-birthday', [BirthdayController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-birthday');
    Route::post('/create-birthday', [BirthdayController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-birthday');
    // Route::get('/view-message/{message}', [BirthdayController::class, 'show'])
    //                 ->middleware('auth')
    //                 ->name('view-message');
    // Route::get('/edit-message/{message}', [BirthdayController::class, 'edit'])
    //                 ->middleware('auth')
    //                 ->name('edit-message');
    // Route::post('/update-message/{message}', [BirthdayController::class, 'update'])
    //                 ->middleware('auth')
    //                 ->name('update-message');
    // Route::post('/delete-message/{message}', [BirthdayController::class, 'destroy'])
    //                 ->middleware('auth')
    //                 ->name('delete-message');
    

    // Admin area
    Route::group([
        'prefix'=>'admin',
        'middleware'=>'is_admin',
        // 'as'=>'admin.'
    ], function(){
        // pupils
        Route::get('/pupils', [PupilController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('pupils');

        Route::get('/add-pupil', [PupilController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-pupil');
        Route::post('/add-pupil', [PupilController::class, 'store'])
                        ->middleware('auth')
                        ->name('add-pupil');
        Route::get('/edit-pupil/{id}', [PupilController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-pupil');
        Route::post('/update-pupil/{pupil}', [PupilController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-pupil');
        Route::post('/delete-pupil/{pupil}', [PupilController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-pupil');

                        
        // teachers
        Route::get('/teachers', [TeacherController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('teachers');
        Route::get('/add-teacher', [TeacherController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-teacher');
        Route::post('/add-teacher', [TeacherController::class, 'store'])
                        ->middleware('auth')
                        ->name('add-teacher');
        Route::get('/edit-teacher/{teacher}', [TeacherController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-teacher');
        Route::post('/update-teacher/{teacher}', [TeacherController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-teacher');
        Route::post('/delete-teacher/{teacher}', [TeacherController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-teacher');

        
        // parents
        Route::get('/parents', [PupilParentController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('parents');
        Route::get('/add-parent', [PupilParentController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-parent');
        Route::post('/add-parent', [PupilParentController::class, 'store'])
                        ->middleware('auth')
                        ->name('add-parent');
        Route::get('/edit-parent/{parent}', [PupilParentController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-parent');
        Route::post('/update-parent/{parent}', [PupilParentController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-parent');
        Route::post('/delete-parent/{parent}', [PupilParentController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-parent');

        
    });

    
    // Parents area
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){

    });
});
