<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;

/*
|--------------------------------------------------------------------------
| PUBLIC ADMIN API ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'apiLogin']);

