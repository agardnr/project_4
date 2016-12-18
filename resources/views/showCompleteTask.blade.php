
@extends('layouts.master')


@section('title')
    To Do List
@endsection


@section('head')
@endsection


@section('task')
<div class="container">

  @if(Session::has('flash_message'))
   {{Session::get('flash_message')}}
   @endif

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

@stop
