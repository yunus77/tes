<?php

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

use App\Http\Controllers\KaryawanController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('karyawan', KaryawanController::class); 

    Route::get('/absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');   
    Route::post('/absensi', [App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/create', [App\Http\Controllers\AbsensiController::class, 'create'])->name('absensi.create');
    Route::delete('/absensi/{id}', [App\Http\Controllers\AbsensiController::class, 'destroy'])->name('absensi.destroy');

    Route::get('/payroll', [App\Http\Controllers\PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/{id}', [App\Http\Controllers\PayrollController::class, 'show'])->name('payroll.show'); 
    Route::post('/payroll', [App\Http\Controllers\PayrollController::class, 'store'])->name('payroll.store');
    Route::delete('/payroll/{id}', [App\Http\Controllers\PayrollController::class, 'destroy'])->name('payroll.destroy');
});