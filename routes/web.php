<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

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

Route::get('/', [SiteController::class, 'index']);

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/client', [SiteController::class, 'client'])->name('client');
    Route::get('/vet', [SiteController::class, 'vet'])->name('vet');

    // User Profile
    Route::get('/user/profile', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/profile', [UserController::class, 'update'])->name('user.update');

    // Patient (represents both patient and appointment in this structure)
    Route::get('/patient/edit/{id}', [SiteController::class, 'editPatient'])->name('patient.edit');
    Route::put('/patient/{id}', [SiteController::class, 'updatePatient'])->name('patient.update');

    // Appointment
    Route::get('/appointment/create', [SiteController::class, 'createAppointment'])->name('appointment.create');
    Route::post('/appointment', [SiteController::class, 'storeAppointment'])->name('appointment.store');
    Route::get('/appointment/edit/{id}', [SiteController::class, 'editAppointment'])->name('appointment.edit');
    Route::put('/appointment/update/{id}', [SiteController::class, 'updateAppointment'])->name('appointment.update');
    Route::delete('/appointment/delete/{id}', [SiteController::class, 'destroyAppointment'])->name('appointment.destroy');
});
