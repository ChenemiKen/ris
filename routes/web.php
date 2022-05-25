<?php

use App\Http\Controllers\PupilController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PupilParentController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
 
require __DIR__.'/auth.php';
require __DIR__.'/web/results.php';
require __DIR__.'/web/results/primary.php';
require __DIR__.'/web/results/nursery.php';
require __DIR__.'/web/results/beacon.php';

// Routes
Route::group(['middleware'=>'auth'], function(){
    // Index or home
    Route::get('/', function(){
        if(Gate::allows('is-admin')){
            $home = RouteServiceProvider::ADMIN_HOME;
        }elseif(Gate::allows('is-teacher')){
            $home = RouteServiceProvider::TEACHER_HOME;
        }elseif(Gate::allows('is-parent')){
            $home = RouteServiceProvider::PARENT_HOME;
        }
        return redirect()->intended($home);
    }) ->middleware('auth')
        ->name('home');


    // -------------Users area(routes accessible to all types of users)-------------//
    //manage homeworks
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
    Route::get('/view-homework/{homework}', [HomeworkController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-homework');


    //manage messages
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


    // manage birthdays
    Route::get('/birthdays', [BirthdayController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('birthdays');
    Route::get('/add-birthday', [BirthdayController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-birthday');
    Route::post('/create-birthday', [BirthdayController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-birthday');

   
    // manage events
    Route::get('/calendar', [EventController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('calendar');
    Route::get('/add-event', [EventController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-event');
    Route::post('/create-event', [EventController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-event');

    
    // Staff area (Routes accessible to only Teacher and Admin users)-----------------//
    Route::group([
        'middleware'=>'is_staff',
        'prefix'=>'staff',
    ], function(){
        // manage pupils
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

         // Admin area (Routes accessible to only Admin users)-----------------//
        Route::group([
            'middleware'=>'is_admin',
            'prefix'=>'staff',
        ], function(){               
            // manage teachers
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
        });

        
        // manage parents
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


    
    // Parents area (Routes accessible by only Parent users. quite rare.)
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){});

});
