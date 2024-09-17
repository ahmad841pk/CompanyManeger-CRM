<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("login", [AuthenticationController::class, "signIn"]);
Route::post("logout", [AuthenticationController::class, "logout"]);


include('employee.php');
include('company.php');
