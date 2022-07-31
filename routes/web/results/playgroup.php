<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\Playgroup\PlaygroupTermReportController;

/*
|--------------------------------------------------------------------------
|Playgroup Result Routes
|--------------------------------------------------------------------------
| Here is where I register web routes pertaining to the beacon section of results.
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
        //Users area(routes accessible to all types of users)-------------//
        // Manage term reports
        Route::get('/playgroup-reports', [PlaygroupTermReportController::class, 'index'])
                ->middleware(['auth'])
                ->name('playgroup-reports');
        Route::get('/add-playgroup-report', [PlaygroupTermReportController::class, 'create'])
                ->middleware('auth')
                ->name('add-playgroup-report');
        Route::post('/create-playgroup-report', [PlaygroupTermReportController::class, 'store'])
                ->middleware('auth')
                ->name('create-playgroup-report');
        Route::get('/view-playgroup-report/{report}', [PlaygroupTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-playgroup-report');
        Route::get('/edit-playgroup-report/{report}', [PlaygroupTermReportController::class, 'edit'])
                ->middleware('auth')
                ->name('edit-playgroup-report');
        Route::post('/update-playgroup-report/{report}', [PlaygroupTermReportController::class, 'update'])
                ->middleware('auth')
                ->name('update-playgroup-report');
        Route::post('/delete-playgroup-report/{report}', [PlaygroupTermReportController::class, 'destroy'])
                ->middleware('auth')
                ->name('delete-playgroup-report');
        Route::get('/view-playgroup-report/{report}', [PlaygroupTermReportController::class, 'show'])
                ->middleware('auth')
                ->name('view-playgroup-report');
        Route::get('/download-playgroup-report/{report}', [PlaygroupTermReportController::class, 'downloadPDF'])
                ->middleware('auth')
                ->name('download-playgroup-report');
});
