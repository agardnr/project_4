
@extends('layouts.master')


@section('title')
    To Do List
@endsection


@section('head')
<meta name="_token" content="{!! csrf_token() !!}" />
<!--<link href='/css/list.css' type='text/css' rel='stylesheet'>-->
<script src="/js/list.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection


@section('task')
<!-- Panel 2 -->
<!-- Incomplete Tasks Table -->
<div class="container">
<div class="panel panel-info" id='Incomplete_task'>
  <div class="panel-heading">To Do</div>
    <div class="panel-body">
      <!-- Panel Content -->
      <table class="table table">
        <thead>
          <tr>
            <th>Task</th>
            <th>Date Due</th>
          </tr>
        </thead>
        <tbody>


            @foreach ($tasks as $task)
            @if ($task->status == 1)

            <form action="/show/{{ $task->id }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}

            <input name='id' value='{{$task->id}}' type='hidden'>

            <tr>
            <td>
           <input class="form-control" type="text" id="task_description" name="task_description" value='{{ old('task_description', $task->task_description) }}' placeholder="Task Description"></input>
           </td>
            <td>
            <input type="date" class="form-control" id="task_due" name="task_due" value="{{ old('task_due', $task->task_due) }}" placeholder="Task Due"></input>
          </td>



            <!-- Edit Task -->
            <td><button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>

              </form>


            <!-- Update Status for soft delete -->
            <td>
              <form action="/show/{{ $task->id }}/{{0}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <button class="btn btn-link">Mark Complete</button>
              </form>
            </td>
            </tr>

            @endif
           @endforeach
         </tbody>
         </table>
    </div>
  </div>
  </div

@endsection


@section('body')
@stop
