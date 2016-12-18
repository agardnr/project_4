
@extends('layouts.master')


@section('title')
    To Do List
@endsection


@section('head')

@endsection


@section('task')
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


   <!-- Panel 1 -->
   <div class="panel-group">
     <div class="panel panel-info" id='new_task'>
       <div class="panel-heading">Add New Task</div>
       <div class="panel-body">
         <div>
           <form class= "form-inline" method="post" action="/show">

             {{ csrf_field() }}

           <div class="col-xs-8">
          <input class="form-control" type="text" id="new_task_description" name="new_task_description" placeholder="Task Description"></input>
          </div>

          <input type="date" class="form-control" id="new_task_due" name="new_task_due" placeholder="Task Due"></input>

           <button class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
         </form>

         </div>
       </div>
     </div>


<!-- Panel 2 -->
<!-- Incomplete Tasks Table -->
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

    <!-- Panel 3 -->
     <!-- Complete Tasks Table -->
     <div class="panel panel-info" id='complete_task'>
       <div class="panel-heading">Completed Tasks</div>
    <div class="panel-body">
      <!-- Panel Content -->
    <table class="table table">
      <thead>
        <tr>
          <th>Task</th>
          <th>Date Completed</th>
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
    <td><div class="completed_task">{{$task->task_description }}</td></div>
    <td><div class="completed_task">{{$task->completed_at }}</td></div>



    <!-- Update Task -->
    <td><button type="submit" class="btn btn-link">Undo</button></td>

      </form>


    <!-- Delete Task -->
    <td>
      <form action="/destroy/{{ $task->id }}" method="get">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button class="btn btn-link"><span class="glyphicon glyphicon-trash"></span> Delete</button>
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
</div>

@endsection


@section('body')
@stop
