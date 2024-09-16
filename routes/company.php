<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('company', CompanyController::class)->except(['create', 'edit']);
});


