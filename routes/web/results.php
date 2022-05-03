<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\SubjectController;
use App\Http\Controllers\Result\SkillController;
use App\Http\Controllers\Result\SkillCategoryController;
use App\Http\Controllers\Result\TermController;
use App\Http\Controllers\Result\TestController;
use App\Http\Controllers\Result\TermReportController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Result Routes
|--------------------------------------------------------------------------
| Here I register web routes pertaining to the entire results section of the application
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
    // -------------Users area(routes accessible to all types of users, both Parents and Admins)-------------//
    Route::get('/results', function(){
        if(Auth::user()->type_type == 'App\\Models\\Admin'){
            return redirect()->route('result-directory');
        }elseif(Auth::user()->type_type == 'App\\Models\\Teacher'){

        }else{

        }
    })->middleware(['auth'])
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
    Route::post('/view-test/{test}', [TestController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-test');
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
    
    
    // Manage term reports
    Route::get('/reports', [TermReportController::class, 'index'])
                    ->middleware(['auth'])
                    ->name('reports');
    Route::get('/add-report', [TermReportController::class, 'create'])
                    ->middleware('auth')
                    ->name('add-report');
    Route::post('/create-report', [TermReportController::class, 'store'])
                    ->middleware('auth')
                    ->name('create-report');
    Route::post('/view-report/{report}', [TermReportController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-report');
    Route::get('/edit-report/{report}', [TermReportController::class, 'edit'])
                    ->middleware('auth')
                    ->name('edit-report');
    Route::post('/update-report/{report}', [TermReportController::class, 'update'])
                    ->middleware('auth')
                    ->name('update-report');
    Route::post('/delete-report/{report}', [TermReportController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('delete-report');
    Route::get('/view-report/{report}', [TermReportController::class, 'show'])
                    ->middleware('auth')
                    ->name('view-report');

    

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
        Route::post('/subjects', [SubjectController::class, 'index'])
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
        
        
        // Manage subjects
        Route::get('/skills', [SkillController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('skills');
        Route::post('/skills', [SkillController::class, 'index'])
                        ->middleware(['auth'])
                        ->name('skills');
        Route::get('/add-skill', [SkillController::class, 'create'])
                        ->middleware('auth')
                        ->name('add-skill');
        Route::post('/create-skill', [SkillController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-skill');
        Route::get('/edit-skill/{skill}', [SkillController::class, 'edit'])
                        ->middleware('auth')
                        ->name('edit-skill');
        Route::post('/update-skill/{skill}', [SkillController::class, 'update'])
                        ->middleware('auth')
                        ->name('update-skill');
        Route::post('/delete-skill/{skill}', [SkillController::class, 'destroy'])
                        ->middleware('auth')
                        ->name('delete-skill');
       

        // Manage skill category
        Route::post('/create-skill-category', [SkillCategoryController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-skill-category');
       

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

        
        //intermediate result router page for admins  
        Route::get('/result-directory', function(){
            return view('results.result-directory');
        })->middleware('auth')
            ->name('result-directory');
        
    });

    

    // Parents area (Routes accessible by only Parent users. quite rare.)
    Route::group([
        'prefix'=>'parent',
        'as'=>'parent',
    ], function(){});
    
});