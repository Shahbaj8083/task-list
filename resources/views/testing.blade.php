<h1>Task list</h1>

@if(isset($name))
    <h2>This is called</h2>
@endif

{{-- @if(count($tasks)) --}}

<div>
    @forelse($tasks as $task)
        <a href= "{{route('tasks.show', ['id' => $task->id])}}" >{{$task->title}}</a><br>
         {{-- <li>{{$task->title}}</li><br> --}}
    @empty
        <li>No task found</li>
    @endforelse
</div>
{{-- @endif --}}