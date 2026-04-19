<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;


/*
|--------------------------
| Public routes
|--------------------------
*/

Route::post('/login', [AuthController::class, 'apiLogin']);

/*
|--------------------------
| Protected routes
|--------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', function (Request $request) {
        return response()->json([
            'message' => 'You are authenticated',
            'user' => $request->user()
        ]);
    });
    Route::get('/companies/{company}', [CompanyController::class, 'show']);
});
