<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'showHome'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/client', [SiteController::class, 'showClientDashboard'])->name('client.dashboard');
    Route::get('/vet', [SiteController::class, 'showVetDashboard'])->name('vet.dashboard');

    Route::post('/patient/create', [UserController::class, 'storePatient'])->name('patient.store');
    Route::get('/patient/{patient}/edit', [UserController::class, 'editPatient'])->name('patient.edit');
    Route::put('/patient/{patient}', [UserController::class, 'updatePatient'])->name('patient.update');
    Route::delete('/patient/{patient}', [UserController::class, 'deletePatient'])->name('patient.delete');

    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment/create', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointments/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('appointment.slots');
    Route::get('/vet/appointment/{appointment}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/vet/appointment/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');
});
