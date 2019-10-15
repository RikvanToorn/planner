<?php

use Illuminate\Database\Seeder;
use App\Group;


class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group                   = new Group();
        $group->name             = 'Testgroep 1';
        $group->description      = 'Beschrijving van testgroep 1.';
        $group->created_by_user  = 1;
        $group->deadline         = new DateTime();
        $group->save();

        $group                   = new Group();
        $group->name             = 'Testgroep 2';
        $group->description      = 'Beschrijving van testgroep 2.';
        $group->created_by_user  = 1;
        $group->deadline         = new DateTime();
        $group->save();

        $group                   = new Group();
        $group->name             = 'Testgroep 3';
        $group->description      = 'Beschrijving van testgroep 3.';
        $group->created_by_user  = 2;
        $group->deadline         = new DateTime();
        $group->save();

        $group                   = new Group();
        $group->name             = 'Testgroep 4';
        $group->description      = 'Beschrijving van testgroep 4.';
        $group->created_by_user  = 3;
        $group->deadline         = new DateTime();
        $group->save();

        $group_users = array(
            array('group_id'=> 1, 'user_id'=> 1, 'role'=> 'admin'),
            array('group_id'=> 1, 'user_id'=> 2, 'role'=> 'moderator'),
            array('group_id'=> 1, 'user_id'=> 3, 'role'=> 'member'),
            array('group_id'=> 1, 'user_id'=> 4, 'role'=> 'member'),
            array('group_id'=> 2, 'user_id'=> 1, 'role'=> 'admin'),
            array('group_id'=> 2, 'user_id'=> 2, 'role'=> 'member'),
            array('group_id'=> 3, 'user_id'=> 1, 'role'=> 'member'),
            array('group_id'=> 3, 'user_id'=> 2, 'role'=> 'admin'),
        );

        DB::table('group_user')->insert($group_users);
    }
}
