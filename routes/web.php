<?php

use App\Http\Controllers\CalendarController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/calendar')->group(function () {

    Route::get('/', [CalendarController::class, 'show'])->name('calendar');
    Route::get('/get_calendar', [CalendarController::class, 'getAllCalendar'])->name('calendar.ajax');

    Route::get('/add_schedule', [CalendarController::class, 'showAddSchedule'])->name('calendar.add_schedule');
    Route::post('/add_schedule', [CalendarController::class, 'postAddSchedule'])->name('calendar.add_schedule.post');

    Route::get('/edit_schedule/{id}', [CalendarController::class, 'showEditSchedule'])->name('edit.schedule');
    Route::post('/edit_schedule/{id}', [CalendarController::class, 'postEditSchedule'])->name('edit.schedule.post');

    Route::get('/delete_schedule/{id}', [CalendarController::class, 'deleteSchedule'])->name('delete.schedule');
});
