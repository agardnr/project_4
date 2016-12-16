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

     public function landing()
     {
         return view('auth.landing');

     }

public function index(Request $request)
{

  $user = $request->user();

  # Note: We're getting the user from the request, but you can also get it like this:
  //$user = Auth::user();

  if($user) {
      # Approach 1)
      //$tasks = Task::where('user_id', '=', $user->id)->orderBy('id','DESC')->get();
      //$tasks = Task::where('user_id', '=', $user->id)->orderBy('id','DESC')->get();

      # Approach 2) Take advantage of Model relationships
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate= date required, not blank (if submitted), date must be after current
        /*
        $this->validate($request, [
           'task_description' => 'required|min:3',
           'task_due' => ''
       ]);
       */
       $user = $request->user();
       $task_description = $request->input('task_description');
       $task_due = $request->input('task_due');
       $task = new Task();
       $task->task_description = $request->input('task_description');
       $task->task_due = $request->input('task_due');
       $task->status = 1;
       //echo $user;
      // $user = User::where('email','like', $user_email)->first();

           # Connect this user_id to this task_id
      $user->tasks()->save($task);
    //   $task->user_id = $request->user()->id; # <--- NEW LINE
      // $task->save();

    //   return redirect('/show');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*---
    public function show()
    {
        $tasks = Task::all();

        # Make sure we have results before trying to print them...
        if(!$tasks->isEmpty()) {

            # Output the tasks
            foreach($tasks as $task) {
                echo $task->task_description.'<br>';
            }
        }
        else {
            echo 'No tasks found';
        }
    }
-----*/
/*---
    public function show()
    {
        $tasks = Task::all();
        $tasks = Task::orderBy('task_due','descending')->get();

        # Make sure we have results before trying to print them...
        if(!$tasks->isEmpty()) {

            # Output the tasks

                # Display showTask view
          //      return view('showTask')->with('tasks', $tasks);
          return view('showTask', ['tasks' => $tasks]);

        }
        else {
            echo 'No tasks found';
        }
    }
    --*/

    public function show(Request $request)
    {
        $user = $request->user();

        # Note: We're getting the user from the request, but you can also get it like this:
        //$user = Auth::user();

        if($user) {
            # Approach 1)
            //$tasks = Task::where('user_id', '=', $user->id)->orderBy('id','DESC')->get();
            //$tasks = Task::where('user_id', '=', $user->id)->orderBy('id','DESC')->get();

            # Approach 2) Take advantage of Model relationships
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

        # Note: We're getting the user from the request, but you can also get it like this:
        //$user = Auth::user();

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
    //  $task->date_completed = Carbon\Carbon::now()->toDateTimeString();
    if ($request->status == 0) {
      $task->completed_at = \Carbon\Carbon::now()->toDateTimeString();
    }
    else {
      $task->completed_at = null;
    }

      $task->save();
      //    return to list
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
        //validate, not blank, date>current
        /*
        $this->validate($request, [
           'task_description' => 'required|min:3',
           'task_due' => ''
       ]);
       */

        $task = Task::find($request->id);
        $task->task_description = $request->task_description;
        $task->task_due = $request->task_due;

        $task->save();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # First get a task to delete
        $task = Task::where('id', $id)->first();

        # If we found the task, delete it
        if($task) {

            # Goodbye!
            $task->delete();

        //    return to list
            return redirect('/show');
        }
        else {
            return "Can't delete - Task not found.";
            }


        }


    }
