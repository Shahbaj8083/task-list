<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

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

// class Task
// {
//   public function __construct(
//     public int $id,
//     public string $title,
//     public string $description,
//     public ?string $long_description,
//     public bool $completed,
//     public string $created_at,
//     public string $updated_at
//   ) {

//   }
// }

// $tasks = [
//   new Task(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];

Route::get('/', function () {
    return redirect('/tasks');
});

Route::get('/tasks', function () {
    // return view('welcome');
    return view('testing', ['tasks' => Task::latest()->get()]);
})->name('task.index');

Route::view('/tasks/create', 'create')->name('tasks.create'); #Directly call the view

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id]);

})->name('tasks.store');


Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => Task::findOrFail($id)]);

    /* return view('welcome');
    $tasks = collect($tasks)->firstWhere('id', $id);//changing array to object

    if(!$tasks){
      abort(Response::HTTP_NOT_FOUND);
    }
    */
})->name('tasks.show');










/*
Route::get('/hello', function () {
    return "Hello !";
});

Route::get('/greet/{name}', function($name){
    return "Hello ". $name."!"; 
});

Route::get('/hallo', function(){
    // return 'Hallo';
    return redirect('/hello');
});

Route::get('/view', function(){
    return view('testing',['name'=>'shahbaz']);
});
*/

Route::fallback(function () {
    return "Still got somewhere !!!, url not found";
});

