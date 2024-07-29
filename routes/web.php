<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\AttributeController::class, 'index'])->name('index');

Route::get('/gallery/{id}' ,[App\Http\Controllers\ImageController::class, 'index']);

Route::post('/addAttribute' , [App\Http\Controllers\AttributeController::class, 'store'])->name('addAttribute');


Route::post('/addImage' , [App\Http\Controllers\ImageController::class, 'store'])->name('addimage');

Route::post('/deleteImage' , [App\Http\Controllers\ImageController::class, 'destroy'])->name('deleteImage');

Route::post('/editImage' , [App\Http\Controllers\ImageController::class, 'edit'])->name('editImage');
