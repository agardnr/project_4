
@extends('layouts.master')


@section('title')
Completed Tasks
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
  <div class="panel panel-info" id='complete_task'>
    <div class="panel-heading">
      <div class="row headings">
        <div class="col-sm-5"><h5>Completed Tasks</h5></div>
        <div class="col-sm-3"><h5>Date Completed</h5></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
      </div>
    </div>

    <div class="panel-body">
      <div class="container-fluid">
        <div class="row">
          @foreach ($tasks as $task)
          @if ($task->status == 0)
          <div class="tasks">
            <form action="/show/{{ $task->id }}/{{1}}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <input name='id' value='{{$task->id}}' type='hidden'>
              <div class="col-sm-5 description"><div class="completed_task">{{$task->task_description }}</div></div>
              <div class="col-sm-3"><div class="completed_task">{{$task->completed_at }}</div></div>
              <div class="col-sm-2"><button type="submit" class="btn btn-link">Undo</button></div>
            </form>

            <div class="col-sm-2">
              <form action="/destroy/{{ $task->id }}" method="get">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-link"><span class="glyphicon glyphicon-trash"></span> Delete</button>
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
