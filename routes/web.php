<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClosedPeriodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('workshops.index');
});

Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{workshop}', [WorkshopController::class, 'show'])->name('workshops.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class,'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    //Breeze deo
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Owner
    Route::prefix('owner')->group(function () {
       Route::get('workshops', [WorkshopController::class, 'ownerIndex'])->name('owner.workshops.index');
       Route::get('workshops/create', [WorkshopController::class, 'create'])->name('owner.workshops.create');
       Route::post('workshops', [WorkshopController::class, 'store'])->name('owner.workshops.store');
       Route::get('workshops/{workshop}/edit', [WorkshopController::class, 'edit'])->name('owner.workshops.edit');
       Route::put('workshops/{workshop}', [WorkshopController::class, 'update'])->name('owner.workshops.update');
       Route::delete('workshops/{workshop}', [WorkshopController::class, 'destroy'])->name('owner.workshops.destroy');

       // Radno vreme i nereadni dani
       Route::get('workshops/{workshop}/working-hours' , [WorkingHourController::class, 'index'])->name('owner.working_hours.index');
       Route::post('workshops/{workshop}/working-hours' , [WorkingHourController::class, 'store'])->name('owner.working_hours.store');
       Route::delete('working-hours/{workingHour}', [WorkingHourController::class, 'destroy'])->name('owner.working_hours.destroy');

        Route::get('workshops/{workshop}/closed-periods', [ClosedPeriodController::class,'index'])->name('owner.closed_periods.index');
        Route::post('workshops/{workshop}/closed-periods',[ClosedPeriodController::class,'store'])->name('owner.closed_periods.store');
        Route::delete('closed-periods/{closedPeriod}',    [ClosedPeriodController::class,'destroy'])->name('owner.closed_periods.destroy');
    });
});

require __DIR__.'/auth.php';
