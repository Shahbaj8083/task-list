<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

# Redirect the root URL to the tasks index route
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

# Display a paginated list of tasks on the tasks index page
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10) # Fetch latest tasks, paginated to 10 per page
    ]);
})->name('tasks.index');

# Show the task creation form
Route::view('/tasks/create', 'create')
    ->name('tasks.create'); # This route will show the 'create' view without needing a controller

# Show the task editing form for a specific task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task # Pass the task model instance to the 'edit' view
    ]);
})->name('tasks.edit');

# Display a specific task's details
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task # Pass the task model instance to the 'show' view
    ]);
})->name('tasks.show');

# Store a newly created task
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated()); # Create a new task using validated data

    return redirect()->route('tasks.show', ['task' => $task->id]) # Redirect to the newly created task's detail page
        ->with('success', 'Task created successfully!'); # Flash a success message
})->name('tasks.store');

# Update an existing task
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated()); # Update the task with validated data

    return redirect()->route('tasks.show', ['task' => $task->id]) # Redirect to the updated task's detail page
        ->with('success', 'Task updated successfully!'); # Flash a success message
})->name('tasks.update');

# Delete a specific task
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete(); # Delete the task

    return redirect()->route('tasks.index') # Redirect back to the tasks index page
        ->with('success', 'Task deleted successfully!'); # Flash a success message
})->name('tasks.destroy');

# Toggle the completion status of a specific task
Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete(); # Call a method to toggle the task's completion status

    return redirect()->back()->with('success', 'Task updated successfully!'); # Redirect back with a success message
})->name('tasks.toggle-complete');

# Fallback route for handling any unmatched routes
Route::fallback(function () {
    return 'Still got somewhere!'; # Return a simple message for undefined routes
});
