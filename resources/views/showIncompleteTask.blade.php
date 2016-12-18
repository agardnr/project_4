
@extends('layouts.master')


@section('title')
    To Do List
@endsection


@section('head')

@endsection


@section('task')
<!-- Panel 2 -->
<!-- Incomplete Tasks Table -->
<div class="container">

  <!-- Display Errors -->
  @if(count($errors) > 0)
  <ul>
      @foreach ($errors->all() as $error)

      <div class="text-danger" role="alert">
    <li>{{ $error }}</li>
  </div>
  @endforeach
  </ul>
  @endif

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
           <input class="form-control" type="text" id="task_description" name="update_task_description" value='{{ old('task_description', $task->task_description) }}' placeholder="Task Description"></input>
           </td>
            <td>
            <input type="date" class="form-control" id="task_due" name="update_task_due" value="{{ old('task_due', $task->task_due) }}" placeholder="Task Due"></input>
          </td>



            <!-- Edit Task -->
            <td><button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span> Update</button></td>

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
