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
        $user->name             = 'Rik';
        $user->email            = 'rik@example.com';
        $user->password         = bcrypt( 'rik' );
        $user->save();

        $user                   = new User();
        $user->name             = 'Max';
        $user->email            = 'max@example.com';
        $user->password         = bcrypt( 'max' );
        $user->save();

        $user                   = new User();
        $user->name             = 'Marpessa';
        $user->email            = 'marpessa@example.com';
        $user->password         = bcrypt( 'marpessa' );
        $user->save();

        $user                   = new User();
        $user->name             = 'Giel';
        $user->email            = 'giel@example.com';
        $user->password         = bcrypt( 'giel' );
        $user->save();

        $user                   = new User();
        $user->name             = 'Bas';
        $user->email            = 'bas@example.com';
        $user->password         = bcrypt( 'bas' );
        $user->save();

        $user                   = new User();
        $user->name             = 'Wim';
        $user->email            = 'wim@example.com';
        $user->password         = bcrypt( 'wim' );
        $user->save();
    }
}
