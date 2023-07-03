<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;

use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\MedicalestablishmentController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Icd10Controller;

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

    Route::post('/agenda', [AgendaController::class, 'show']);
    Route::get('/agenda/{id}', [AgendaController::class, 'show']);
    Route::get('/agenda/search/patient', [AgendaController::class, 'searchPatient'])->middleware('throttle:400,1');
    Route::get('/agenda/appointments/types', [AgendaController::class, 'getAppointmentTypes']);
    Route::post('/agenda/appointments/store', [AgendaController::class, 'storeAppointment']);
    Route::post('/agenda/appointments/change', [AgendaController::class, 'changeAppointment']);
    Route::get('/agenda/appointments/{id}', [AgendaController::class, 'index']);
    Route::patch('/agenda/appointments/approve', [AgendaController::class, 'approveAppointment']);
    Route::delete('/agenda/appointments/{id}', [AgendaController::class, 'destroy']);

    Route::get('/medicalestablishment', [MedicalestablishmentController::class, 'index']);
    Route::get('/medicalestablishment/{id}/healthprofessionals', [MedicalestablishmentController::class, 'healthprofessionals']);
    Route::get('/symptom', [SymptomController::class, 'search'])->middleware('throttle:400,1');
    Route::get('/icd10', [Icd10Controller::class, 'search'])->middleware('throttle:400,1');


    Route::get('/consultation/activate/{id}', [ConsultationController::class, 'activate']);
    Route::post('/consultation/close', [ConsultationController::class, 'close']);
    Route::post('/consultation/previous', [ConsultationController::class, 'previous']);

    Route::get('/consultation/notes/medical/{id}', [ConsultationController::class, 'getMedicalNotes']);
    Route::post('/consultation/notes/medical/{id}', [ConsultationController::class, 'storeMedicalNote']);
    Route::delete('/consultation/notes/medical/{id}/{note_id}', [ConsultationController::class, 'deleteMedicalNote']);
    Route::patch('/consultation/notes/medical/{id}', [ConsultationController::class, 'patchMedicalNote']);
    
    Route::get('/consultation/notes/consultation/{id}', [ConsultationController::class, 'getConsultationNotes']);
    Route::post('/consultation/notes/consultation/{id}', [ConsultationController::class, 'storeConsultationNote']);
    Route::delete('/consultation/notes/consultation/{id}/{note_id}', [ConsultationController::class, 'deleteConsultationNote']);
    Route::patch('/consultation/notes/consultation/{id}', [ConsultationController::class, 'patchConsultationNote']);

    Route::get('/consultation/notes/patient/{id}', [ConsultationController::class, 'getPatientNotes']);
    Route::post('/consultation/notes/patient/{id}', [ConsultationController::class, 'storePatientNote']);
    Route::delete('/consultation/notes/patient/{id}/{note_id}', [ConsultationController::class, 'deletePatientNote']);
    Route::patch('/consultation/notes/patient/{id}', [ConsultationController::class, 'patchPatientNote']);

    Route::get('/consultation/problems/{id}', [Icd10Controller::class, 'getProblems']);
    Route::post('/consultation/problems/{id}', [Icd10Controller::class, 'storeProblem']);
    Route::delete('/consultation/problems/{id}/{problem_id}', [Icd10Controller::class, 'deleteProblem']);
    
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