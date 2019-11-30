<?php

use Illuminate\Database\Seeder;
use App\Message;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message                   = new Message();
        $message->title            = 'Rik heeft je uitgenodigd voor deze groep!';
        $message->message          = 'Rik heeft je uitgenodigd voor deze groep!';
        $message->sender_user_id   = 1;
        $message->receiver_user_id = 5;
        $message->group_id         = 1;
        $message->type             = "Invite";
        $message->save();

        $message                   = new Message();
        $message->title            = 'Rik heeft je uitgenodigd voor deze groep!';
        $message->message          = 'Rik heeft je uitgenodigd voor deze groep!';
        $message->sender_user_id   = 1;
        $message->receiver_user_id = 6;
        $message->group_id         = 1;
        $message->type             = "Invite";
        $message->save();

        $message                   = new Message();
        $message->title            = 'Dit is testbericht 1 ';
        $message->message          = 'Tekst in testbericht 1';
        $message->sender_user_id   = 1;
        $message->receiver_user_id = 2;
        $message->group_id         = null;
        $message->type             = "Message";
        $message->save();

        $message                   = new Message();
        $message->title            = 'Dit is testbericht 2';
        $message->message          = 'Tekst in testbericht 2';
        $message->sender_user_id   = 2;
        $message->receiver_user_id = 1;
        $message->group_id         = null;
        $message->type             = "Message";
        $message->save();
    }
}
