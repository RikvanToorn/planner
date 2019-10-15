<?php

use Illuminate\Database\Seeder;
use App\Task;


class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task                   = new Task();
        $task->name             = 'Huurauto regelen';
        $task->description      = 'Regel een huurauto als vervoer om er te kunnen komen';
        $task->created_by_user  = 1;
        $task->group_id         = 1;
        $task->status           = 'Pending';
        $task->user_id          = 1;
        $task->save();

        $task                   = new Task();
        $task->name             = 'Drank halen';
        $task->description      = 'Regel bier en wijn om dronken te worden';
        $task->created_by_user  = 1;
        $task->group_id         = 1;
        $task->status           = 'Pending';
        $task->user_id          = null;
        $task->save();

        $task                   = new Task();
        $task->name             = 'Tent regelen';
        $task->description      = 'Regel een Tent om in te slapen';
        $task->created_by_user  = 2;
        $task->group_id         = 1;
        $task->status           = 'Pending';
        $task->user_id          = 2;
        $task->save();

        $task                   = new Task();
        $task->name             = 'Koelbox';
        $task->description      = 'Regel een koelbox om de drank in te bewaren';
        $task->created_by_user  = 3;
        $task->group_id         = 1;
        $task->status           = 'Pending';
        $task->user_id          = null;
        $task->save();

        $task                   = new Task();
        $task->name             = 'Goed humeur';
        $task->description      = 'Niet janken als we er zijn';
        $task->created_by_user  = 1;
        $task->group_id         = 1;
        $task->status           = 'Completed';
        $task->user_id          = 2;
        $task->save();

        $task                   = new Task();
        $task->name             = 'Naar de klote';
        $task->description      = 'Helemala van het pad af';
        $task->created_by_user  = 1;
        $task->group_id         = 1;
        $task->status           = 'Completed';
        $task->user_id          = 3;
        $task->save();
    }
}
