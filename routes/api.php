<?php

use App\Models\Attribute;
use App\Models\baba;
use App\Models\customer;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/getAttributes', [App\Http\Controllers\Api\AttributeApiController::class, 'getAttributes']);

Route::get('/getImagesFormAttribute', [App\Http\Controllers\Api\AttributeApiController::class, 'getImagesFormAttribute']);

Route::post('/uploadImageToAttribute', [App\Http\Controllers\Api\AttributeApiController::class, 'uploadImageToAttribute']);
