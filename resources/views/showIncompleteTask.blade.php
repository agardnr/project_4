
@extends('layouts.master')


@section('title')
To Do List
@endsection


@section('head')

@endsection


@section('task')

<div class="container">
  @if(count($errors) > 0)
  <ul>
    @foreach ($errors->all() as $error)
    <li><div class="text-danger" role="alert">{{ $error }}</div></li>
    @endforeach
  </ul>
  @endif

  <div class="panel panel-info" id='incomplete_task'>
    <div class="panel-heading">
      <div class="row headings">
        <div class="col-sm-5"><h5>Tasks</h5></div>
        <div class="col-sm-3"><h5>Date Due</h5></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
      </div>
    </div>
    <div class="panel-body">
      <div class="container-fluid">

        <div class="row">
          @foreach ($tasks as $task)
          @if ($task->status == 1)
          <div class="tasks">
            <form action="/show/{{ $task->id }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <input name='id' value='{{$task->id}}' type='hidden'>
              <br>
              <div class="col-sm-5 description"><input class="form-control" type="text" name="update_task_description" value='{{ old('task_description', $task->task_description) }}' placeholder="Task Description"></div>
              <div class="col-sm-3"><input type="date" class="form-control" name="update_task_due" value="{{ old('task_due', $task->task_due) }}"></div>
              <div class="col-sm-2"><button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span> Update</button></div>
            </form>

            <div class="col-sm-2">
              <form action="/show/{{ $task->id }}/{{0}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <button class="btn btn-link">Mark Complete</button>
              </form>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@stop
