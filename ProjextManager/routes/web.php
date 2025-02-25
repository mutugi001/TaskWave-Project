<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WhatsappController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/check-auth', function () {
//     return auth()->user() ?: 'Not logged in';
// });


Route::middleware([
    'auth',
    'web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/check-auth', function () {
        dd(session()->all());

    })->name('check-auth');

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/project/create', 'create')->name('projects.create');
        Route::post('/project/store', 'store')->name('projects.store');
        Route::get('/projects', 'index')->name('projects.index');
        Route::get('/projects/{project}', 'show')->name('projects.show');
        Route::get('/projects/{project}/edit', 'edit')->name('projects.edit');
        Route::put('/projects/{project}', 'update')->name('projects.update');
        Route::delete('/projects/{project}', 'destroy')->name('projects.destroy');
        Route::get('/projects/{project}/tasks', 'tasks')->name('projects.tasks');
    });
    Route::controller(TeamController::class)->group(function () {
        Route::get('/teams', 'index')->name('teams.index');
        Route::get('/teams/{team}', 'show')->name('teams.show');
        Route::get('/teams/{team}/edit', 'edit')->name('teams.edit');
        Route::put('/teams/{team}', 'update')->name('teams.update');
        Route::delete('/teams/{team}', 'destroy')->name('teams.destroy');
        Route::get('/teams/{team}/members', 'members')->name('teams.members');
        Route::get('/team/create', 'create')->name('teams.create');
        Route::post('/team/store', 'store')->name('teams.store');
    });
    Route::controller(MemberController::class)->group(function () {
        Route::get('/members/create', 'create')->name('members.create');
        Route::post('/members/store', 'store')->name('members.store');
        Route::get('/members/{member}/edit', 'edit')->name('members.edit');
        Route::put('/members/{member}', 'update')->name('members.update');
        Route::delete('/members/{member}', 'destroy')->name('members.destroy');
    });
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::post('/tasks/store', 'store')->name('tasks.store');
        Route::get('/tasks/{task}', 'show')->name('tasks.show');
        Route::get('/confirm-task-completion', 'confirmCompletion')->name('tasks.confirmCompletion');
    });

    Route::controller(WhatsappController::class)->group(function () {
        Route::get('/whatsapp', 'index')->name('whatsapp.index');
        Route::get('/whatsapp/store/{member, task}', 'store')->name('whatsapp.store');
    });
});
