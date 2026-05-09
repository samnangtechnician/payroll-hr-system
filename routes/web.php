<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\PayrollPeriodController;
use App\Http\Controllers\Admin\PayrollRunController;
use App\Http\Controllers\Admin\PayslipController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\PublicHolidayController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Route::post('/locale', [LocaleController::class, 'store'])->name('locale.store');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Organization
        Route::get('companies/data', [CompanyController::class, 'data'])->name('companies.data');
        Route::resource('companies', CompanyController::class)->except('show');

        Route::get('branches/data', [BranchController::class, 'data'])->name('branches.data');
        Route::resource('branches', BranchController::class)->except('show');

        Route::get('departments/data', [DepartmentController::class, 'data'])->name('departments.data');
        Route::resource('departments', DepartmentController::class)->except('show');

        Route::get('positions/data', [PositionController::class, 'data'])->name('positions.data');
        Route::resource('positions', PositionController::class)->except('show');

        // People
        Route::get('employees/data', [EmployeeController::class, 'data'])->name('employees.data');
        Route::resource('employees', EmployeeController::class);

        Route::get('users/data', [UserController::class, 'data'])->name('users.data');
        Route::resource('users', UserController::class)->except('show');

        Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class)->except('show');

        // Time
        Route::get('shifts/data', [ShiftController::class, 'data'])->name('shifts.data');
        Route::resource('shifts', ShiftController::class)->except('show');

        Route::get('public-holidays/data', [PublicHolidayController::class, 'data'])->name('public-holidays.data');
        Route::resource('public-holidays', PublicHolidayController::class)->except('show')
            ->parameters(['public-holidays' => 'publicHoliday']);

        Route::get('attendance/data', [AttendanceController::class, 'data'])->name('attendance.data');
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');

        // Leave
        Route::get('leave-types/data', [LeaveTypeController::class, 'data'])->name('leave-types.data');
        Route::resource('leave-types', LeaveTypeController::class)->except('show')
            ->parameters(['leave-types' => 'leaveType']);

        Route::get('leave-requests/data', [LeaveRequestController::class, 'data'])->name('leave-requests.data');
        Route::resource('leave-requests', LeaveRequestController::class)->except('show')
            ->parameters(['leave-requests' => 'leaveRequest']);

        // Payroll
        Route::get('payroll-periods/data', [PayrollPeriodController::class, 'data'])->name('payroll-periods.data');
        Route::resource('payroll-periods', PayrollPeriodController::class)->except('show')
            ->parameters(['payroll-periods' => 'payrollPeriod']);

        Route::get('payroll-runs/data', [PayrollRunController::class, 'data'])->name('payroll-runs.data');
        Route::get('payroll-runs', [PayrollRunController::class, 'index'])->name('payroll-runs.index');

        Route::get('payslips/data', [PayslipController::class, 'data'])->name('payslips.data');
        Route::get('payslips', [PayslipController::class, 'index'])->name('payslips.index');

        // Settings
        Route::get('countries/data', [CountryController::class, 'data'])->name('countries.data');
        Route::get('countries', [CountryController::class, 'index'])->name('countries.index');

        Route::get('currencies/data', [CurrencyController::class, 'data'])->name('currencies.data');
        Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.index');
    });
});
