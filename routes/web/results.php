<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\SubjectController;
use App\Http\Controllers\Result\TermController;

/*
|--------------------------------------------------------------------------
| Result Routes
|--------------------------------------------------------------------------
| Here is where I register web routes pertaining to the results section of the application
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
    // -------------Users area(routes accessible to all types of users, both Parents and Admins)-------------//
    // Manage results
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
    Route::get('/view-result/{result}', [ResultController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-result');

    

    // Admin area (Routes accessible to only admin users)-----------------//
    Route::group([
        'prefix'=>'admin',
        'middleware'=>'is_admin',
        // 'as'=>'admin.'
    ], function(){
        // Manage subjects
        Route::get('/subjects', [SubjectController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('subjects');
        Route::get('/add-subject', [SubjectController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-subject');
        Route::post('/create-subject', [SubjectController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-subject');
        Route::get('/edit-subject/{subject}', [SubjectController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-subject');
        Route::post('/update-subject/{subject}', [SubjectController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-subject');
        Route::post('/delete-subject/{subject}', [SubjectController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-subject');
       
       
        // Manage Terms
        Route::get('/terms', [TermController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('terms');
        Route::get('/add-term', [TermController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-term');
        Route::post('/create-term', [TermController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-term');
        Route::get('/edit-term/{term}', [TermController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-term');
        Route::post('/update-term/{term}', [TermController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-term');
        Route::post('/delete-term/{term}', [TermController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-term');
        
    });

    

    // Parents area (Routes accessible by only Parent users. quite rare.)
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){});
    
});
