<?php

use App\Http\Controllers\PupilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/pupils', [PupilController::class, 'index'])
                ->middleware(['auth'])
                ->name('pupils');

Route::get('/add-pupil', [PupilController::class, 'create'])
                ->middleware('auth')
                ->name('add-pupil');
Route::post('/add-pupil', [PupilController::class, 'store'])
                ->middleware('auth')
                ->name('add-pupil');
Route::get('/edit-pupil/{id}', [PupilController::class, 'edit'])
                ->middleware('auth')
                ->name('edit-pupil');
Route::post('/update-pupil/{pupil}', [PupilController::class, 'update'])
                ->middleware('auth')
                ->name('update-pupil');
Route::post('/delete-pupil/{pupil}', [PupilController::class, 'destroy'])
                ->middleware('auth')
                ->name('delete-pupil');
