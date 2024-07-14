<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;

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
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.store');
Route::get('/admin/movies/{id}/edit',[MovieController::class,'edit'])->name('admin.edit');
Route::get('/admin/movies/{id}/update',[MovieController::class,'update'])->name('admin.update');
Route::patch('/admin/movies/{id}/update',[MovieController::class,'update'])->name('admin.update');
Route::get('/admin/movies/{id}/destroy',[MovieController::class,'destroy'])->name('admin.destroy');
Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'destroy'])->name('admin.destroy');

// sheet
Route::get('/sheets',[SheetController::class,'index'])->name('sheets.index');
