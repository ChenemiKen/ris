<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\Primary\PrimaryTestController;
use App\Http\Controllers\Result\Primary\PrimaryTermReportController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Nursery Result Routes
|--------------------------------------------------------------------------
| Here I register web routes pertaining to the primary results section of the application
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
    //Users area(routes accessible to all types of users)-------------------  
    Route::group(['middleware'=>'is_staff'], function(){            
        // Manage tests
        Route::get('/primary-tests', [PrimaryTestController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('primary-tests');
        Route::get('/add-primary-test', [PrimaryTestController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-primary-test');
        Route::post('/create-primary-test', [PrimaryTestController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-primary-test');
        Route::post('/view-primary-test/{test}', [PrimaryTestController::class, 'show'])
                        ->middleware('auth')
                        ->name('view-primary-test');
        Route::get('/edit-primary-test/{test}', [PrimaryTestController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-primary-test');
        Route::post('/update-primary-test/{test}', [PrimaryTestController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-primary-test');
        Route::post('/delete-primary-test/{test}', [PrimaryTestController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-primary-test');
        Route::get('/view-primary-test/{test}', [PrimaryTestController::class, 'show'])
                        ->middleware('auth')
                        ->name('view-primary-test');
    });
    
    // Manage term reports
    Route::get('/primary-reports', [PrimaryTermReportController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('primary-reports');
    Route::get('/add-primary-report', [PrimaryTermReportController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-primary-report');
    Route::post('/create-primary-report', [PrimaryTermReportController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-primary-report');
    Route::post('/view-primary-report/{report}', [PrimaryTermReportController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-primary-report');
    Route::get('/edit-primary-report/{report}', [PrimaryTermReportController::class, 'edit'])
                    ->middleware('auth')
                    ->name('edit-primary-report');
    Route::post('/update-primary-report/{report}', [PrimaryTermReportController::class, 'update'])
                    ->middleware('auth')
                    ->name('update-primary-report');
    Route::post('/delete-primary-report/{report}', [PrimaryTermReportController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('delete-primary-report');
    Route::get('/view-primary-report/{report}', [PrimaryTermReportController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-primary-report');
    Route::get('/download-primary-report/{report}', [PrimaryTermReportController::class, 'downloadPDF'])
        ->middleware('auth')
        ->name('download-primary-report');
    
});