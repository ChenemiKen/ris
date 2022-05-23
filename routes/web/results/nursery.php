<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\Nursery\NurseryTermReportController;

/*
|--------------------------------------------------------------------------
| Nursery Result Routes
|--------------------------------------------------------------------------
| Here is where I register web routes pertaining to the nursery section of results.
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
        //Users area(routes accessible to all types of users)-------------//
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
        Route::get('/edit-nursery-report/{report}', [NurseryTermReportController::class, 'edit'])
                ->middleware('auth')
                ->name('edit-nursery-report');
        Route::post('/update-nursery-report/{report}', [NurseryTermReportController::class, 'update'])
                ->middleware('auth')
                ->name('update-nursery-report');
        Route::post('/delete-nursery-report/{report}', [NurseryTermReportController::class, 'destroy'])
                ->middleware('auth')
                ->name('delete-nursery-report');
        Route::get('/view-nursery-report/{report}', [NurseryTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-nursery-report');
});
