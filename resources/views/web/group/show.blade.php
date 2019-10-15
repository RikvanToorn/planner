@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-8 mt-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <h3>{{ $group->name }}</h3>
                    <p>{{ $group->description }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <h5>To Do:</h5>
                    <table class="table table-sm table-striped table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 30%">Name</th>
                                <th style="width: 30%">Claimed by</th>
                                <th style="width: 30%"></th>
                                <th style="width: 10%">Admin</th>
                            </tr>
                        </thead>
                        <tbody id="tasks">
                        @foreach($tasks as $task)
                            <tr data-toggle="collapse" data-target="#description {{ $task->id }}" class="accordion-toggle" id="{{ $task->id }}">
                                <th>{{ $task->name }}</th>
                                <td>
                                    @if(isset($task->user_id))
                                        {{ $task->user->name }}
                                    @else
                                        not claimed
                                    @endif

                                </td>
                                <td>
                                    @if(isset($task->user_id) and $task->user_id == Auth::user()->id)
                                        <a class="btn btn-success btn-sm" href="{{ route('task_complete', ['task_id' => $task->id]) }}">Complete</a>
                                    @elseif(isset($task->user_id))
                                    @else
                                        <button type="button" class="btn btn-warning" onclick="dotask({{ $task->id }})" value="{{ $task->id }}">Do</button>
                                    @endif
                                </td>
                                <td>
                                    @if($task->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <a class="btn" href="{{ route('task_delete', ['task_id' => $task->id]) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="accordian-body collapse" id="description {{ $task->id }}">
                                        {{ $task->description }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form method="POST">
                        <input id="group_id" type="hidden" value={{ $group->id }}>
                        <div class="row">
                            <div class="col-5">
                                <input type="text" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control" id="description" placeholder="Description">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary" id="addtask">Add</button>
                            </div>
                        </div>
                    </form>
                    <h5 class="mt-3">Completed Tasks:</h5>
                    <table class="table table-sm table-striped ">
                        <thead>
                        <tr>
                            <th style="width: 30%">Name</th>
                            <th style="width: 30%">Completed by</th>
                            <th style="width: 30%"></th>
                            <th style="width: 10%">Admin</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completedtasks as $completedtask)
                            <tr>
                                <th scope="row">{{ $completedtask->name }}</th>
                                <td>
                                    {{ $completedtask->user->name }}
                                </td>
                                <td>
                                    @if($completedtask->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <a class="btn btn-danger btn-sm" href="{{ route('task_open', ['task_id' => $completedtask->id]) }}">Move back</a>
                                    @endif
                                </td>
                                <td>
                                    @if($completedtask->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <a class="btn" href="{{ route('task_delete', ['task_id' => $completedtask->id]) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4 mt-5">
                <div class="row">
                    <div class="col-12">
                        <h5>Groupmembers</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($groupmembers as $groupmember)
                                    <tr>
                                        <td scope="row">{{ $groupmember->name }}</td>
                                        <td scope="row">{{ $groupmember->pivot->role }}</td>
                                        <td scope="row">
                                            @if($user_role == 'admin' and $groupmember->id != Auth::user()->id)
                                                <a class="btn" href="{{ route('group_remove_groupmember', ['group_id' => $group->id, 'user_id' => $groupmember->id]) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($user_role == 'admin' or $user_role == 'moderator')
                <div class="row mb-4">
                    <div class="col-12">
                        <form class="form-horizontal">
                            <input id="group_id" type="hidden" value={{ $group->id }}>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Search for groupmembers">
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" id="search">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                <div class="row bg-light">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="results">
                            </tbody>
                        </table>
                </div>
                </div>
        </div>
    </div>


@endsection