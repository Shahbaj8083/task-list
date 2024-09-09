<h1>Task list</h1>

@if(isset($name))
    <h2>This is called</h2>
@endif

{{-- @if(count($tasks)) --}}

<div>
    @forelse($tasks as $task)
         <li>{{$task->title}}</li><br>
    @empty
        <li>No task found</li>
    @endforelse
</div>
{{-- @endif --}}