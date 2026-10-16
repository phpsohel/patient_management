<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientApiController;
// Route::middleware('auth:sanctum')->apiResource(
//     'patients',
//     PatientApiController::class
// );
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
