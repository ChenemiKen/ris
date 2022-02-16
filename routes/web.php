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

Route::get('/pupils', function () {
    return view('pupil');
})->middleware(['auth'])->name('dashboard');

Route::get('/add-pupil', [PupilController::class, 'create'])
                ->middleware('auth')
                ->name('add-pupil');
Route::post('/add-pupil', [PupilController::class, 'store'])
                ->middleware('auth')
                ->name('add-pupil');
