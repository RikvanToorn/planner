<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user                   = new User();
        $user->name             = 'user';
        $user->email            = 'user@example.com';
        $user->password         = bcrypt( 'user' );
        $user->save();

        $moderator               = new User();
        $moderator->name         = 'moderator';
        $moderator->email        = 'moderator@example.com';
        $moderator->password     = bcrypt( 'moderator' );
        $moderator->save();

        $admin                  = new User();
        $admin->name            = 'admin';
        $admin->email           = 'admin@example.com';
        $admin->password        = bcrypt( 'admin' );
        $admin->save();
    }
}
