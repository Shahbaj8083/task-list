<?php

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

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {

  }
}

$tasks = [
  new Task(
    1,
    'Buy groceries',
    'Task 1 description',
    'Task 1 long description',
    false,
    '2023-03-01 12:00:00',
    '2023-03-01 12:00:00'
  ),
  new Task(
    2,
    'Sell old stuff',
    'Task 2 description',
    null,
    false,
    '2023-03-02 12:00:00',
    '2023-03-02 12:00:00'
  ),
  new Task(
    3,
    'Learn programming',
    'Task 3 description',
    'Task 3 long description',
    true,
    '2023-03-03 12:00:00',
    '2023-03-03 12:00:00'
  ),
  new Task(
    4,
    'Take dogs for a walk',
    'Task 4 description',
    null,
    false,
    '2023-03-04 12:00:00',
    '2023-03-04 12:00:00'
  ),
];

Route::get('/', function () use($tasks){
    // return view('welcome');
    return view('testing', ['tasks'=> $tasks]);
})->name('task.index');

Route::get('/{id}', function (){
    // return view('welcome');
    return view('single task view');
})->name('task.show');


// Route::get('/hello', function () {
//     return "Hello !";
// });

// Route::get('/greet/{name}', function($name){
//     return "Hello ". $name."!"; 
// });

// Route::get('/hallo', function(){
//     // return 'Hallo';
//     return redirect('/hello');
// });

Route::fallback(function(){
    return "Still got somewhere !!!, url not found";
});

// Route::get('/view', function(){
//     return view('testing',['name'=>'shahbaz']);
// });

