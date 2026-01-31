<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Attendances\Attendance;
use App\Livewire\Employer\Attendance\AttendancePage;
use App\Livewire\Employer\Departments\EditDepartment;
use App\Livewire\Employer\Departments\DepartmentList;
use App\Livewire\Employer\Departments\AddDepartment;
use App\Livewire\Employer\Employee\AddEmployee;
use App\Livewire\Employer\Employee\EmployeeList;
use App\Livewire\Employer\Employee\EditEmployee;
use App\Livewire\Employer\Payroll\Addpayroll;
use App\Livewire\Employer\Payroll\EditPayroll;
use App\Livewire\Employer\Payroll\PayrollList;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Documentation;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Documentation Routes
//Route::get('/documentation/payroll', Documentation::class)
    //->name('documentation.payroll');


// Employer Dashboard Route
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'employer'])
    ->name('employer.dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

//Admin Dashboard Route
Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

    //Employee
    Route::get('/employee-list', EmployeeList::class)->name('employee.index');
    Route::get('/create/employee', AddEmployee::class)->name('employee.create');
    Route::get('/edit/employee/{id}', EditEmployee::class)->name('employee.edit');

    //Department
    Route::get('/department/list', DepartmentList::class)->name('department.index');
    Route::get('/department/create', AddDepartment::class)->name('department.create');
    Route::get('/edit/department/{id}', EditDepartment::class)->name('department.edit');

    //Attendances
    Route::get('/employee/attendance', AttendancePage::class)->name('attendance.index');

    //Payroll
    Route::get('/payroll/list', PayrollList::class)->name('payroll.index');
    Route::get('/payroll/create', Addpayroll::class)->name('payroll.create');
    Route::get('/payroll/edit/{id}', EditPayroll::class)->name('payroll.edit');

});
