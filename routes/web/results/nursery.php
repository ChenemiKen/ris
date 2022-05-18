<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\Nursery\NurseryTermReportController;

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
        // Manage term reports
        Route::get('/nursery-reports', [NurseryTermReportController::class, 'index'])
                ->middleware(['auth'])
                ->name('nursery-reports');
        Route::get('/add-nursery-report', [NurseryTermReportController::class, 'create'])
                ->middleware('auth')
                ->name('add-nursery-report');
        Route::post('/create-nursery-report', [NurseryTermReportController::class, 'store'])
                ->middleware('auth')
                ->name('create-nursery-report');
        Route::get('/view-nursery-report/{report}', [NurseryTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-nursery-report');
        Route::get('/edit-nursery-report/{nursery-report}', [NurseryTermReportController::class, 'edit'])
                ->middleware('auth')
                ->name('edit-nursery-report');
        Route::post('/update-nursery-report/{nursery-report}', [NurseryTermReportController::class, 'update'])
                ->middleware('auth')
                ->name('update-nursery-report');
        Route::post('/delete-nursery-report/{nursery-report}', [NurseryTermReportController::class, 'destroy'])
                ->middleware('auth')
                ->name('delete-nursery-report');
        Route::get('/view-nursery-report/{nursery-report}', [NurseryTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-nursery-report');


    // Admin area (Routes accessible to only admin users)-----------------//
    Route::group([
        'prefix'=>'admin',
        'middleware'=>'is_admin',
        // 'as'=>'admin.'
    ], function(){
        
    });

    
    // Parents area (Routes accessible by only Parent users. quite rare.)
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){});
    
});
