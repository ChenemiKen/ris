<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\NurserySubjectController;

/*
|--------------------------------------------------------------------------
| Result Routes
|--------------------------------------------------------------------------
| Here is where I register web routes pertaining to the nursery section of results.
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
    // -------------Users area(routes accessible to all types of users, both Parents and Admins)-------------//
    

    // Admin area (Routes accessible to only admin users)-----------------//
    Route::group([
        'prefix'=>'admin',
        'middleware'=>'is_admin',
        // 'as'=>'admin.'
    ], function(){
        // Manage Nursery ubjects
        Route::get('/nursery-subjects', [NurserySubjectController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('nursery-subjects');
        Route::post('/nursery-subjects', [NurserySubjectController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('nursery-subjects');
        Route::get('/add-nursery-subject', [NurserySubjectController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-nursery-subject');
        Route::post('/create-nursery-subject', [NurserySubjectController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-nursery-subject');
        Route::get('/edit-nursery-subject/{nursery-subject}', [NurserySubjectController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-nursery-subject');
        Route::post('/update-nursery-subject/{nursery-subject}', [NurserySubjectController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-nursery-subject');
        Route::post('/delete-nursery-subject/{nursery-subject}', [NurserySubjectController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-nursery-subject');
        
    });

    

    // Parents area (Routes accessible by only Parent users. quite rare.)
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){});
    
});
