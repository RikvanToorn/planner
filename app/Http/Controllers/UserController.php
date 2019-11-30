<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group as Group;
use App\User as User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showuser($user_id)
    {
        $data = [];

        $user = User::find($user_id);
        $data['user'] = $user;

        return view('web.user.show', $data);
    }

    public function updateavatar(Request $request){

        $this->validate(
            $request,
            [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();
    }


}
