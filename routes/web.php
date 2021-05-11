<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//public about us
Route::redirect('/', '/aboutus');
Route::redirect('/dashboard', '/aboutus');
Route::view('/aboutus', 'aboutus')->name('aboutus');

//Users Appointments Scheduler
Route::get('/appointment', [AppointmentController::class, 'index'])
    ->middleware(['auth'])
    ->middleware(['hasnotappointment'])
    ->name('appointment');

//Users Take Appointments
Route::get('/appointment/{date}/{hour}', [AppointmentController::class, 'store'])
    ->middleware(['auth'])
    ->middleware(['hasnotappointment'])
    ->name('createappointment');

//User see his appointment
Route::get('/appointment/show/', [AppointmentController::class, 'show'])
    ->middleware(['auth'])
    ->name('show');

//Confirmation Request before delete Appointments Route 
Route::post('/appointment/edit/{appointment}', [AppointmentController::class, 'edit'])
    ->middleware(['auth'])
    ->name('edit');

//Delete Appointments Route 
Route::post('/appointment/destroy/{id}', [AppointmentController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('destroy');

//Admin Appointments Scheduler
Route::get('/admin', [AppointmentController::class, 'indexadmin'])
        ->middleware(['auth'])
        ->middleware(['isadmin'])
        ->name('admin');

require __DIR__.'/auth.php';