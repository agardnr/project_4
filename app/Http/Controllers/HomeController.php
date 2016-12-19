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


}
