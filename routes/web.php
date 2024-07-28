<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;

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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice',[PracticeController::class,'getPractice']);

// movie
Route::get('/movies',[MovieController::class,'index'])->name('index');
Route::get('/movies/{id}',[MovieController::class,'show'])->name('show');
Route::get('/admin/movies',[MovieController::class,'admin'])->name('admin');
Route::get('/admin/movies/create',[MovieController::class,'create'])->name('admin.create');
Route::get('/admin/movies/{id}',[MovieController::class,'admin_show'])->name('admin.show');
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.store');
Route::get('/admin/movies/{id}/edit',[MovieController::class,'edit'])->name('admin.edit');
Route::get('/admin/movies/{id}/update',[MovieController::class,'update'])->name('admin.update');
Route::patch('/admin/movies/{id}/update',[MovieController::class,'update'])->name('admin.update');
Route::get('/admin/movies/{id}/destroy',[MovieController::class,'destroy'])->name('admin.destroy');
Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'destroy'])->name('admin.destroy');

// sheet
Route::get('/sheets',[SheetController::class,'index'])->name('sheets.index');
Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets',[SheetController::class,'show'])->name('sheet.show');

// schedule
Route::get('/admin/schedules',[ScheduleController::class,'index'])->name('schedules.index');
Route::get('/admin/movies/{id}/schedules/create',[ScheduleController::class,'create'])->name('schedule.create');
Route::post('/admin/movies/{id}/schedules/store',[ScheduleController::class,'store'])->name('schedule.store');
Route::get('/admin/schedules/{id}',[ScheduleController::class,'show'])->name('schedule.show');
Route::get('/admin/schedules/{id}/edit',[ScheduleController::class,'edit'])->name('schedule.edit');
Route::get('/admin/schedules/{id}/update',[ScheduleController::class,'update'])->name('schedule.update');
Route::patch('/admin/schedules/{id}/update',[ScheduleController::class,'update'])->name('schedule.update');
Route::get('/admin/schedules/{id}/destroy',[ScheduleController::class,'destroy'])->name('schedule.destroy');
Route::delete('/admin/schedules/{id}/destroy',[ScheduleController::class,'destroy'])->name('schedule.destroy');

// reservation
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create',[ReservationController::class,'create'])->name('reservation.create');
Route::post('/reservations/store',[ReservationController::class,'store'])->name('reservation.store');
