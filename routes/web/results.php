<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\SubjectController;
use App\Http\Controllers\Result\TermController;
use App\Http\Controllers\Result\TestController;

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
    Route::get('/results', [TestController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('results');
                    
    // Manage tests
    Route::get('/tests', [TestController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('tests');
    Route::get('/add-test', [TestController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-test');
    Route::post('/create-test', [TestController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-test');
    Route::get('/edit-test/{test}', [TestController::class, 'edit'])
                    ->middleware('auth')
                    ->name('edit-test');
    Route::post('/update-test/{test}', [TestController::class, 'update'])
                    ->middleware('auth')
                    ->name('update-test');
    Route::post('/delete-test/{test}', [TestController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('delete-test');
    Route::get('/view-test/{test}', [TestController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-test');

    

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
