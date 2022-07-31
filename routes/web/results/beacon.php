<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\Beacon\BeaconTermReportController;

/*
|--------------------------------------------------------------------------
| Beacon Result Routes
|--------------------------------------------------------------------------
| Here is where I register web routes pertaining to the beacon section of results.
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
        //Users area(routes accessible to all types of users)-------------//
        // Manage term reports
        Route::get('/beacon-reports', [BeaconTermReportController::class, 'index'])
                ->middleware(['auth'])
                ->name('beacon-reports');
        Route::get('/add-beacon-report', [BeaconTermReportController::class, 'create'])
                ->middleware('auth')
                ->name('add-beacon-report');
        Route::post('/create-beacon-report', [BeaconTermReportController::class, 'store'])
                ->middleware('auth')
                ->name('create-beacon-report');
        Route::get('/view-beacon-report/{report}', [BeaconTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-beacon-report');
        Route::get('/edit-beacon-report/{report}', [BeaconTermReportController::class, 'edit'])
                ->middleware('auth')
                ->name('edit-beacon-report');
        Route::post('/update-beacon-report/{report}', [BeaconTermReportController::class, 'update'])
                ->middleware('auth')
                ->name('update-beacon-report');
        Route::post('/delete-beacon-report/{report}', [BeaconTermReportController::class, 'destroy'])
                ->middleware('auth')
                ->name('delete-beacon-report');
        Route::get('/view-beacon-report/{report}', [BeaconTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-beacon-report');
        Route::get('/download-beacon-report/{report}', [BeaconTermReportController::class, 'downloadPDF'])
                ->middleware('auth')
                ->name('download-beacon-report');
});
