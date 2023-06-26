<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalestablishmentController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sanctum/token', TokenController::class);

Route::middleware(['auth:sanctum', 'apply_locale'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/contact', [ProfileController::class, 'updateContact']);
    Route::get('/profile/contact', [ProfileController::class, 'getContact']);
    Route::post('/profile/address', [ProfileController::class, 'updateAddress']);
    Route::get('/profile/address', [ProfileController::class, 'getAddress']);
    Route::get('/profile/workplace', [ProfileController::class, 'getWorkplace']);
    Route::post('/profile/workplace', [ProfileController::class, 'updateWorkplace']);

    Route::get('/agenda', [AgendaController::class, 'show']);
    Route::get('/agenda/{id}', [AgendaController::class, 'show']);
    Route::get('/agenda/search/patient', [AgendaController::class, 'searchPatient'])->middleware('throttle:400,1');
    Route::post('/agenda/appointment/store', [AgendaController::class, 'store']);
    Route::get('/agenda/appointments/{id}', [AgendaController::class, 'index']);
    Route::delete('/agenda/appointment/{id}', [AppointmentController::class, 'destroy']);

    Route::get('/medicalestablishment', [MedicalestablishmentController::class, 'index']);
    Route::get('/medicalestablishment/{id}/healthprofessionals', [MedicalestablishmentController::class, 'healthprofessionals']);
    Route::get('/symptom', [SymptomController::class, 'search'])->middleware('throttle:400,1');
    /**
     * Auth related
     */
    Route::get('/users/auth', AuthController::class);


    /**
     * Users
     */
    Route::put('/users/{user}/avatar', [UserController::class, 'updateAvatar']);
    Route::resource('users', UserController::class);

    /**
     * Roles
     */
    Route::get('/roles/search', [RoleController::class, 'search'])->middleware('throttle:400,1');
});