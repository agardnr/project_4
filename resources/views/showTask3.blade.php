
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

   <!-- Panel 1 -->
   <div class="panel-group">
     <div class="panel panel-info" id='new_task'>
       <div class="panel-heading">Add New Task</div>
       <div class="panel-body">
         <!-- Body here -->
         <div>
           <form method="post" action="/show">
             {{ csrf_field() }}
           <input class="form-control .col-lg-*" type="text" id="new_task_description" name="task_description" placeholder="Task Description"></input>
           <input type="date" id="new_task_due" name="task_due" placeholder="Task Due"></input>
           <button class="btn btn-link">Add</button>
           </form>
           @if(count($errors) > 0)
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       @endif
         </div>
       </div>
     </div>


<!-- Panel 2 -->
<!-- Incomplete Tasks Table -->
<div class="panel panel-info" id='Incomplete_task'>
  <div class="panel-heading">To Do</div>
    <div class="panel-body">
      <!-- Panel Content -->
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
            @if ($task->status == 1)

            <form action="/show/{{ $task->id }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}

            <input name='id' value='{{$task->id}}' type='hidden'>

            <tr>
            <td class="task_list"><div>{{ $task->id}}</div></td>
            <td><div><input type="text" name="task_description" id="task_description" value='{{ old('task_description', $task->task_description) }}'></td></div>
            <td><div><input type="text" name="task_due" id="task_due" value="{{ old('task_due', $task->task_due) }}"></input></td></div>



            <!-- Edit Task -->
            <td><button type="submit" class="btn btn-link">Edit</button></td>

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

    <!-- Panel 3 -->
     <!-- Complete Tasks Table -->
     <div class="panel panel-info" id='complete_task'>
       <div class="panel-heading">Completed Tasks</div>
    <div class="panel-body">
      <!-- Panel Content -->
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
    @if ($task->status == 0)

    <!-- Undo Soft Delete -->
    <form action="/show/{{ $task->id }}/{{1}}" method="POST">
      {{ method_field('PUT') }}
      {{ csrf_field() }}

    <input name='id' value='{{$task->id}}' type='hidden'>

    <tr>
    <td class="task_list"><div>{{ $task->id}}</div></td>
    <td><div>{{$task->task_description }}</td></div>
    <td><div>{{$task->task_due }}</td></div>



    <!-- Update Task -->
    <td><button type="submit" class="btn btn-link">Undo</button></td>

      </form>


    <!-- Delete Task -->
    <td>
      <form action="/destroy/{{ $task->id }}" method="get">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button class="btn btn-link">Delete</button>
      </form>
    </td>
    </tr>

    @endif

    @endforeach



</tbody>

</table>
    </div>
  </div>







</div>



@endsection


@section('body')
@stop
