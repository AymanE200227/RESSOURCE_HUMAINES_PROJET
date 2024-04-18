<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'permission:do-tasks'])->group(function () {
    Route::get('/tasks/assigned', [TaskController::class, 'doTask'])->name('tasks.assigned');
    Route::post('/tasks/{taskId}/start', [TaskController::class, 'startTask'])->name('tasks.start');
    Route::post('/tasks/{taskId}/finish', [TaskController::class, 'finishTask'])->name('tasks.finish');
    
});


Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'posts' => PostController::class,
]);

Route::middleware(['auth', 'permission:manage-leave'])->group(function () {
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::put('/conges/{conge}', [CongeController::class, 'update'])->name('conges.update');
});

Route::middleware(['auth', 'permission:request-leave'])->group(function () {
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::put('/conges/{conge}', [CongeController::class, 'update'])->name('conges.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/conges/my-requests', [CongeController::class, 'myRequests'])->name('conges.my-requests');
});

Route::middleware(['auth', 'permission:manage-evaluations'])->group(function () {
    Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
});

Route::middleware(['auth', 'permission:manage-presence'])->group(function () {
    Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');
    Route::get('/presences/create', [PresenceController::class, 'create'])->name('presences.create');
    Route::post('/presences', [PresenceController::class, 'store'])->name('presences.store');
});

Route::middleware(['auth', 'permission:manage-projects'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

Route::middleware(['auth', 'permission:manage-works'])->group(function () {
    Route::get('/works/create', [WorkController::class, 'create'])->name('works.create');
    Route::get('/works/create/start', [WorkController::class, 'createStart'])->name('works.create.start');
    Route::post('/works', [WorkController::class, 'store'])->name('works.store');
    Route::get('/works/{work}/edit', [WorkController::class, 'edit'])->name('works.edit');
    Route::put('/works/{work}', [WorkController::class, 'update'])->name('works.update');
    Route::delete('/works/{work}', [WorkController::class, 'destroy'])->name('works.destroy');
});

Route::middleware(['auth', 'permission:manage-tasks'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/{task}/assign/page', [TaskController::class, 'assignPage'])->name('tasks.assign.page');
    Route::post('/tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});



