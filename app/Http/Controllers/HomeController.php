<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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


}
