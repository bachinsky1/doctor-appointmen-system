<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicalestablishmentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AddressController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'role:administrator,health-professional,patient'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/contact', [ProfileController::class, 'updateContact']);
    Route::get('/profile/contact', [ProfileController::class, 'getContact']);
    Route::post('/profile/address', [ProfileController::class, 'updateAddress']);
    Route::get('/profile/address', [ProfileController::class, 'getAddress']);

    Route::group(['middleware' => 'role:health-professional,patient'], function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
    });

    Route::group(['middleware' => 'role:health-professional'], function () { 
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
        Route::get('/billing', [BillingController::class, 'index'])->name('billing');
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
        Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
        Route::get('/profile/workplace', [ProfileController::class, 'getWorkplace']);
        Route::post('/profile/workplace', [ProfileController::class, 'updateWorkplace']);
    });

    Route::group(['middleware' => 'role:administrator'], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/medicalestablishments', [MedicalestablishmentController::class, 'index'])->name('medicalestablishments');
        Route::delete('/medicalestablishments/{id}', [MedicalestablishmentController::class, 'destroy'])->name('medicalestablishments.destroy');;
    });
});
