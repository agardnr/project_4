
@extends('layouts.master')


@section('title')
    To Do List
@endsection


@section('head')
<meta name="_token" content="{!! csrf_token() !!}" />
<!--<link href='/css/list.css' type='text/css' rel='stylesheet'>-->
<script src="/js/list.js"></script>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection


@section('task')
<div class="container">

  @if(Session::has('flash_message'))
   {{Session::get('flash_message')}}
@endif

  <div>
    <form method="post" action="/show">
      {{ csrf_field() }}
    <input type="text" id="new_task_description" name="task_description" placeholder="Task Description"></input>
    <input type="date" id="new_task_due" name="task_due" placeholder="Task Due"></input>
    <button>Add</button>
    </form>
  </div>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Task</th>
        <th>Date Due</th>
      </tr>
    </thead>
    <tbody>


        @foreach ($tasks as $task)

        <form action="/show/{{ $task->id }}" method="POST">
          {{ method_field('PUT') }}
          {{ csrf_field() }}

        <!-- <input name="_method" type="hidden" value="PUT">-->

        <input name='id' value='{{$task->id}}' type='hidden'>

        <tr>
        <td class="task_list"><div>{{ $task->id}}</div></td>
        <td><div><input type="text" name="task_description" id="task_description" value='{{ old('task_description', $task->task_description) }}'></td></div>
        <td><div><input type="text" name="task_due" id="task_due" value="{{ old('task_due', $task->task_due) }}"></input></td></div>



        <!-- Update Button -->
        <td><button type="submit" class="btn btn-primary">Update Task</button></td>

          </form>


        <!-- Delete Button -->
        <td>
          <form action="/destroy/{{ $task->id }}" method="get">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button>Mark Completed</button>
          </form>
        </td>
        </tr>

        @endforeach



    </tbody>

  </table>




</div>



@endsection


@section('body')
@stop
