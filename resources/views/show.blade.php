@extends('layouts.app')

@section('title')
<h3>{{$task->title}}</h3>
@endsection

@section('content')

<p>{{$task->description}}</p>

@if($task->long_description)
<p>{{$task->long_description}}</p>
@endif

<p>{{$task->completed == true ? "Yes" : "No"}}</p>
<p>{{$task->created_at}}</p>
<p>{{$task->updated_at}}</p>

@endsection
