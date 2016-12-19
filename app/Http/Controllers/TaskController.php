<?php

namespace App\Http\Controllers;
//namespace Carbon\Carbon;
//use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use App\User;
use Session;
use Auth;

class TaskController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function create()
  {
    return view('createTask');
  }

  public function index(Request $request)
  {

    $user = $request->user();

    if($user) {

      $tasks = $user->tasks()->get();
    }
    else {
      $tasks = [];
    }

    return view('showTask')->with([
      'tasks' => $tasks
    ]);

  }


  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $this->validate($request, [
      'new_task_description' => 'required|min:3',
      'new_task_due' => 'required|date'
    ]);

    $user = $request->user();
    $task_description = $request->input('new_task_description');
    $task_due = $request->input('new_task_due');
    $task = new Task();
    $task->task_description = $request->input('new_task_description');
    $task->task_due = $request->input('new_task_due');
    $task->status = 1;

    $user->tasks()->save($task);

    return redirect('/show');

  }


  public function show(Request $request)
  {
    $user = $request->user();

    if($user) {

      $tasks = $user->tasks()->get();
    }
    else {
      $tasks = [];
    }

    return view('showTask')->with([
      'tasks' => $tasks
    ]);


  }

  public function showIncomplete(Request $request)
  {
    $user = $request->user();

    if($user) {
      $tasks = $user->tasks()->get();
    }
    else {
      $tasks = [];
    }
    if ($request->completion == 'incomplete') {
      return view('showIncompleteTask')->with([
        'tasks' => $tasks
      ]);
    }
    elseif ($request->completion == 'complete') {
      return view('showCompleteTask')->with([
        'tasks' => $tasks
      ]);
    }

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update_status(Request $request)
  {
    $task = Task::find($request->id);
    $task->status = $request->status;

    if ($request->status == 0) {
      $task->completed_at = \Carbon\Carbon::now()->toDateTimeString();
    }
    else {
      $task->completed_at = null;
    }

    $task->save();

    return redirect('/show');
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */


  public function update(Request $request)
  {
    $this->validate($request, [
      'update_task_description' => 'required|min:3',
      'update_task_due' => 'required|date'
    ]);

    $task = Task::find($request->id);
    $task->task_description = $request->update_task_description;
    $task->task_due = $request->update_task_due;

    $task->save();

    return redirect('/show');
  }


  public function destroy(Request $request)
  {
    $task = Task::find($request->id);

    if($task) {

      $task->delete();

      return redirect('/show');
    }
    else {
      return "Can't delete - Task not found.";
    }
  }
}
