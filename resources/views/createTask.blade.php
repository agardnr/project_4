@extends('layouts.master')
@section('title')
Add Task
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

  <div class="panel-group">
    <div class="panel_1">
      <div class="panel panel-info" id='new_task'>
        <div class="panel-heading"><h5>Add New Task</h5></div>
        <div class="panel-body">
          <div>
            <form class= "form-inline" method="post" action="/show">
              {{ csrf_field() }}
              <div class="col-xs-8">
                <input class="form-control" type="text" id="new_task_description" name="new_task_description" placeholder="Task Description">
              </div>
              <input type="date" class="form-control" id="new_task_due" name="new_task_due">
              <button class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
