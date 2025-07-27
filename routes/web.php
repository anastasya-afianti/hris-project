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
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tasks - role_id 1, 2, 3
    Route::middleware(['role:1,2,3'])->group(function () {
        Route::resource('/tasks', TaskController::class);
        Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
        Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');
    });

    // Employees - role_id 1 only
    Route::middleware(['role:1'])->group(function () {
        Route::resource('/employees', EmployeeController::class);
        Route::resource('/departments', DepartmentController::class);
        Route::resource('/roles', RoleController::class);
        Route::get('leave-requests/confirm/{id}', [LeaveRequestController::class, 'confirm'])->name('leave-requests.confirm');
        Route::get('leave-requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
        Route::get('leave-requests/pending/{id}', [LeaveRequestController::class, 'pending'])->name('leave-requests.pending');
    });

    // Presences, Payrolls, Leave Requests - role_id 1, 2, 3
    Route::middleware(['role:1,2,3'])->group(function () {
        Route::resource('/presences', PresencesController::class);
        Route::resource('/payrolls', PayrollController::class);
        Route::get('/payrolls/{payroll}/pdf', [PayrollController::class, 'exportPdf'])->name('payrolls.pdf');
        Route::resource('/leave-requests', LeaveRequestController::class);
    });

    // Profile (semua yang login bisa akses)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
