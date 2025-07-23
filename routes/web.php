<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\PayrollController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Handle Tasks
Route::resource('/tasks', TaskController::class);
Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');

//Handle Employee
Route::resource('/employees', EmployeeController::class);

// Handle department
Route::resource('/departments', DepartmentController::class);

// Handle Roles
Route::resource('/roles', RoleController::class);

// Handle presences
Route::resource('/presences', PresencesController::class);

// Handle Payrolls
Route::resource('/payrolls', PayrollController::class);
Route::get('/payrolls/{payroll}/pdf', [PayrollController::class, 'exportPdf'])->name('payrolls.pdf');

// Handle Leave Request
Route::resource('/leave-requests',  LeaveRequestController::class);
Route::get('leave-requests/confirm/{id}', [LeaveRequestController::class, 'confirm'])->name('leave-requests.confirm');
Route::get('leave-requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
Route::get('leave-requests/pending/{id}', [LeaveRequestController::class, 'pending'])->name('leave-requests.pending');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
