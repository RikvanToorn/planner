@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <h3>Users</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td scope="row">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a class="btn-succes p-2 px-4 ml-4" href="{{  route('group_add_groupmember', ['group_id' => $group->id, 'user_id' => $user->id]) }}">Invite</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection