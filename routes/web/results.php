<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Result\SubjectController;
use App\Http\Controllers\Result\SkillController;
use App\Http\Controllers\Result\SkillCategoryController;
use App\Http\Controllers\Result\TermController;
use App\Http\Controllers\Result\TestController;
use App\Http\Controllers\Result\TermReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Result Routes
|--------------------------------------------------------------------------
| Here I register web routes pertaining to the entire results section of the application
|
*/

// Routes
Route::group(['middleware'=>'auth'], function(){
    // Users area(routes accessible to all types of users)-------------//
    Route::get('/results', function(){
        if(Gate::allows('is-admin')){
            return redirect()->route('result-directory');
        }elseif(Gate::allows('is-teacher')){
            switch(auth()->user()->teacher->class){
                case "beacon":
                    $reports = 'beacon-reports';
                    break;
                case "lower_primary":
                    $reports = 'primary-reports';
                    break;
                case "upper_primary":
                    $reports = 'primary-reports';
                    break;
                case "nursery":
                    $reports = 'nursery-reports';
                    break;
                case "playgroup":
                    $reports = 'playgroup-reports';
                    break;
            }
            return redirect()->route($reports);
        }elseif(Gate::allows('is-parent')){
            switch(auth()->user()->pupil_parent->pupil->class){
                case "beacon":
                    $reports = 'beacon-reports';
                    break;
                case "lower_primary":
                    $reports = 'primary-reports';
                    break;
                case "upper_primary":
                    $reports = 'primary-reports';
                    break;
                case "nursery":
                    $reports = 'nursery-reports';
                    break;
                case "playgroup":
                    $reports = 'playgroup-reports';
                    break;
            }
            return redirect()->route($reports);
        }
    })->middleware(['auth'])
        ->name('results');

    // Staff area (Routes accessible to only Teachers and Admin users)-----------------//
    Route::group([
        'prefix'=>'staff',
        'middleware'=>'is_staff',
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
       

        // Manage skill category
        Route::post('/create-skill-category', [SkillCategoryController::class, 'store'])
                        ->middleware('auth')
                        ->name('create-skill-category');
       
                        

        // Admin area (Routes accessible to only Admin users)-----------------//
        Route::group([
            'prefix'=>'admin',
            'middleware'=>'is_admin',
            // 'as'=>'admin.'
        ], function(){
            //intermediate result router page for admins  
            Route::get('/result-directory', function(){
                return view('results.result-directory');
            })->middleware('auth')
                ->name('result-directory');
        });
    });
    
});