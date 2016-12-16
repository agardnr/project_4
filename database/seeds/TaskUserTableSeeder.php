<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\User;

class TaskUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # First, create an array of all the books we want to associate tags with
  # The *key* will be the book title, and the *value* will be an array of tags.


  $tasks =[
      'Do laundry' => ['jill@harvard.edu','jamal@harvard.edu','agardner@fas.harvard.edu'],
      'Buy groceries' => ['jamal@harvard.edu'],
      'Make dinner' => ['agardner@fas.harvard.edu']
  ];

  # Now loop through the above array, creating a new pivot for each book to tag
  foreach($tasks as $task_description => $users) {

      # First get the task id
      $task = Task::where('task_description','LIKE', $task_description)->first();

      # Now loop through each user_id for this task_id, adding the pivot
      foreach($users as $user_email) {
      $user = User::where('email','like', $user_email)->first();

          # Connect this user_id to this task_id
          $user->tasks()->save($task);
      }

  }
    }
}
