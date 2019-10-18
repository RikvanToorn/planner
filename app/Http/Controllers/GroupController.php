<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group as Group;
use App\User as User;

class GroupController extends Controller
{
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function index() {
        $data = [];
        $groups = Auth::user()->groups()->get();
        $data['groups'] = $groups;


        return view('web.group.index', $data);
    }

    public function newgroup(Request $request) {
        $data = [];
        $data['users'] = [];
        if( $request->old('group_user_list')) {
            $data['users'] = User::whereIn('id', $request->old('group_user_list'))->get();
        }
        return view('web.group.new', $data);
    }

    public function creategroup(Request $request) {
        if($request->group_user_list) {
            $users = User::whereIn('id', $request->group_user_list)->get();
        } else {
            $users = [];
        };
        $group = new Group();

        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->deadline = $request->input('deadline');
        $group->created_by_user = Auth::user()->id;

        $this->validate(
            $request,
            [
                'name' => 'required|min:5',
                'description' => 'required',
                'deadline' => 'required',
            ]
        );

        $group->save();
        Auth::user()->groups()->attach($group, ['role' => 'admin']);
        $group->users()->attach($users, ['role' => 'member']);


        return redirect('groups');
    }

    public function showgroup($group_id) {

        $data = [];

        $group = Group::find($group_id);
        $data['group'] = $group;

        $groupmembers = Group::find($group_id)->users()->get();
        $data['groupmembers'] = $groupmembers;

        $user_role = Group::find($group_id)->users()->find(Auth::user()->id);
        $data['user_role'] = $user_role->pivot->role;

        $tasks = $group->tasks()->where('status', 'pending')->get();
        $data['tasks'] = $tasks;
        $completedtasks = $group->tasks()->where('status', 'completed')->get();
        $data['completedtasks'] = $completedtasks;

        return view('web.group.show', $data);
    }



    public function modifygroup($group_id) {
        $data = [];
        $data['group_id'] = $group_id;
        $group_data = Group::find($group_id);
        $data['name'] = $group_data->name;
        $data['description'] = $group_data->description;
        $data['deadline'] = $group_data->deadline;
        return view('web.group.edit', $data);
    }

    public function updategroup(Request $request, $group_id) {
        $group = Group::find($group_id);

        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->deadline = $request->input('deadline');

        $this->validate(
            $request,
            [
                'name' => 'required|min:5',
                'description' => 'required',
                'deadline' => 'required',
            ]
        );

        $group->save();
        return redirect('groups');
    }

    public function searchgroupmember(Request $request) {

        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
            ]
        );
        $data = [];
        if($request->input('group_id') == "test") {
            $data['users'] = User::where('name', 'LIKE', '%'. $request->input('name'). '%')->orWhere('email', 'LIKE', '%'. $request->input('name'). '%')->get();
            $data['group'] = null;
            return response()->json($data);
        }
        else {
            $data['group'] = Group::find($request->input('group_id'));
            $groupusers = Group::find($request->input('group_id'))->users()->pluck('email')->toArray();
            $data['users'] = User::whereNotIn('email', $groupusers)->where('name', 'LIKE', '%'. $request->input('name'). '%')->Where('email', 'LIKE', '%'. $request->input('name'). '%')->get();
            return response()->json($data);
        }


    }

    public function addgroupmember($group_id, $user_id) {
        $group = Group::find($group_id);
        $user = User::find($user_id);

        $group->users()->attach($user, ['role' => 'member']);
        return response()->json($user);
    }

    public function removegroupmember($group_id, $user_id) {
        $group = Group::find($group_id);
        $user = User::find($user_id);
        group::find($group_id)->tasks()->where([['user_id', $user_id],['status','!=', 'completed']])->update(['user_id'=>null]);

        $group->users()->detach($user);
        return redirect()->back();
    }

    public function addtask(Request $request) {
        $id = Auth::id();
        $task = new Task();
        $task['name'] = $request->input('name');
        $task['description'] = $request->input('description');
        $task['status'] = 'pending';
        $task['created_by_user'] = $id;

        $group = Group::find($request->input('group_id'));



        $group->tasks()->save($task);
        return response()->json($task);
    }

    public function dotask($task_id) {
        $task = Task::find($task_id);
        $task->user_id = Auth::user()->id;

        $task->save();
        return response()->json($task);
    }

    public function completetask($task_id) {
        $task = Task::find($task_id);
        $task->status = 'Completed';

        $task->save();
        return response()->json($task);
    }

    public function opentask($task_id) {
        $task = Task::find($task_id);
        $task->status = 'pending';

        $task->save();
        return response()->json($task);
    }

    public function deletetask($task_id) {
        $task = Task::find($task_id);
        $task->delete();

        return response()->json($task);
    }
}
