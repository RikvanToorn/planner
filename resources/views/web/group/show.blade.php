@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-8 mt-3">
            <div class="row">
                <div class="col-12 mt-3 border-bottom">
                    <h3>{{ $group->name }} <br>
                    <small>{{ $group->description }}</small>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3" id="allTasks">
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
                        <tbody id="openTasks">
                        @foreach($tasks as $task)
                            <tr data-toggle="collapse" data-target="#description{{ $task->id }}" class="accordion-toggle" id="task{{ $task->id }}">
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
                                        <button class="btn btn-success btn-sm complete-task-button" value="{{ $task->id }}">Complete</button>
                                    @elseif(isset($task->user_id))
                                    @else
                                        <button class="btn btn-warning btn-sm do-task-button" value="{{ $task->id }}">Do</button>
                                    @endif
                                </td>
                                <td>
                                    @if($task->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <button class="btn btn-danger btn-sm delete-task-button" value="{{ $task->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="accordian-body collapse" id="description{{ $task->id }}">
                                        {{ $task->description }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form id="addTask">
                        <input id="group_id" type="hidden" value={{ $group->id }}>
                        <div class="row">
                            <div class="col-5">
                                <input type="text" class="form-control" id="taskName" placeholder="Name">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control" id="taskDescription" placeholder="Description">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Add</button>
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
                        <tbody id="completedTasks">
                        @foreach($completedtasks as $completedtask)
                            <tr data-toggle="collapse" data-target="#description{{ $completedtask->id }}" class="accordion-toggle" id="task{{ $completedtask->id }}">
                                <th>{{ $completedtask->name }}</th>
                                <td>
                                    @if(isset($completedtask->user_id))
                                        {{ $completedtask->user->name }}
                                    @else
                                        not claimed
                                    @endif
                                </td>
                                <td>
                                    @if($completedtask->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <button class="btn btn-warning btn-sm open-task-button" value="{{ $completedtask->id }}">Move back</button>
                                    @endif
                                </td>
                                <td>
                                    @if($completedtask->user_id == Auth::user()->id or $user_role == 'admin' or $user_role == 'moderator')
                                        <button class="btn btn-danger btn-sm delete-task-button" value="{{ $completedtask->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="accordian-body collapse" id="description{{ $completedtask->id }}">
                                        {{ $completedtask->description }}
                                    </div>
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
                            <tbody id="groupMembers">
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
                        <form id="searchUsers" class="form-horizontal">
                            <input id="group_id" type="hidden" value={{ $group->id }}>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Search for groupmembers">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary" id="search">Submit</button>
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