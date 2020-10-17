<?php

use App\Task;
use App\Label;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'name' => 'Task manager',
            'description' => 'Hexlet project 4 "Task manager"',
            'status_id' => 1,
            'created_by_id' => 3,
            'assigned_to_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('label_task')->insert([
            'label_id' => 1,
            'task_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('label_task')->insert([
            'label_id' => 2,
            'task_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('label_task')->insert([
            'label_id' => 3,
            'task_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('label_task')->insert([
            'label_id' => 4,
            'task_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('label_task')->insert([
            'label_id' => 5,
            'task_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
