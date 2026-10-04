<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        $stats = [
            'employees' => \App\Models\Employee::count(),
            'departments' => \App\Models\Department::count(),
            'projects_active' => \App\Models\Project::where('status', 'en_cours')->count(),
            'projects_done' => \App\Models\Project::where('status', 'termine')->count(),
        ];

        $recentProjects = \App\Models\Project::withCount('employees')->latest()->take(5)->get();
        $recentEmployees = \App\Models\Employee::with('department')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentProjects', 'recentEmployees'));
    })->name('dashboard');

    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('projects', ProjectController::class);

    Route::post('/projects/{project}/attach-employee', [ProjectController::class, 'attachEmployee'])->name('projects.attach-employee');
    Route::delete('/projects/{project}/detach-employee/{employee}', [ProjectController::class, 'detachEmployee'])->name('projects.detach-employee');

});