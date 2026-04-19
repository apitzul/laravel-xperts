<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Models\Company;
use App\Models\Employee;

/*
|--------------------------------------------------------------------------
| PUBLIC API ROUTES
|--------------------------------------------------------------------------
*/
// Route::prefix('api')->group(function () {
//     Route::post('/login', [AuthController::class, 'apiLogin']);
// });
/*
|--------------------------------------------------------------------------
| PUBLIC ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::fallback(function () {
    return redirect()->route('admin.login');
});


Route::post('/login', [AuthController::class, 'apiLogin']);

/*
|--------------------------------------------------------------------------
| PROTECTED ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('admin.dashboard');

        // LOGOUT
        Route::post('/logout', function () {
            Auth::guard('admin')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('admin.logout');

        /*
        |-------------------------
        | COMPANIES
        |-------------------------
        */

        Route::get('/companies', function () {
            $companies = Company::latest()->paginate(10);
            return view('admin.companies.index', compact('companies'));
        })->name('admin.companies.index');

        Route::get('/companies/create', fn () =>
            view('admin.companies.create')
        )->name('admin.companies.create');

        Route::post('/companies', [CompanyController::class, 'store'])
            ->name('admin.companies.store');

        Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])
            ->name('admin.companies.edit');

        Route::put('/companies/{company}', [CompanyController::class, 'update'])
            ->name('admin.companies.update');

        Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])
            ->name('admin.companies.destroy');

        /*
        |-------------------------
        | EMPLOYEES
        |-------------------------
        */

        Route::get('/employees', function () {
            $employees = Employee::latest()->paginate(10);
            return view('admin.employees.index', compact('employees'));
        })->name('admin.employees.index');

        Route::get('/employees/create', fn () =>
            view('admin.employees.create')
        )->name('admin.employees.create');

        Route::post('/employees', [EmployeeController::class, 'store'])
            ->name('admin.employees.store');

        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('admin.employees.edit');

        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
            ->name('admin.employees.update');

        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
            ->name('admin.employees.destroy');
    });
