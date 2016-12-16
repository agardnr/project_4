<?php

use Illuminate\Database\Seeder;
use App\User;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // user faker for seed data
      $faker = \Faker\Factory::create();
  //    $user_id = User::where('email','=','jill@harvard.edu')->pluck('id')->first();
     //$user_id = 01;
      DB::table('tasks')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
  //    'user_id' => $user_id,
      'task_due' => $faker->dateTimeBetween($startDate ='+1 day', $endDate = '+1 year'),
      'task_description' => "Do laundry",
      'status' => 1
    ]);

  //    $user_id = User::where('email','=','jamal@harvard.edu')->pluck('id')->first();
      DB::table('tasks')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
  //    'user_id' => $user_id,
      'task_due' => $faker->dateTimeBetween($startDate ='+1 day', $endDate = '+1 year'),
      'task_description' => "Finish P4",
      'status' => 1
    ]);

//    $user_id = User::where('email','=','jill@harvard.edu')->pluck('id')->first();
    DB::table('tasks')->insert([
    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
//    'user_id' => $user_id,
    'task_due' => $faker->dateTimeBetween($startDate ='+1 day', $endDate = '+1 year'),
    'task_description' => "Buy groceries",
    'status' => 1
    ]);

  //  $user_id = User::where('email','=','agardner@fas.harvard.edu')->pluck('id')->first();
    DB::table('tasks')->insert([
    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
  //  'user_id' => $user_id,
    'task_due' => $faker->dateTimeBetween($startDate ='+1 day', $endDate = '+1 year'),
    'task_description' => "Make dinner",
    'status' => 1
    ]);

    }
}
