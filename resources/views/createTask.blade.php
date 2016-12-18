
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



@endsection


@section('body')
@stop
