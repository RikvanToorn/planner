@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-12 my-3">
            <h3>New group</h3>
            <form id="groupForm" class="form-horizontal" method="POST" action="{{ route('group_create') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>Group name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="{{ old('name') }}">
                    <small class="error">{{$errors->first('name')}}</small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                    <small class="error">{{$errors->first('description')}}</small>
                </div>
                <div class="form-group">
                    <label>Deadline Datum</label>
                    <input type="date" class="form-control" name="deadline" value="{{ old('deadline', date('Y-m-d')) }}">
                    <small class="error">{{$errors->first('deadline')}}</small>
                </div>
                    @if(old('group_user_list'))
                        @foreach( old('group_user_list') as $user)
                            <input type="hidden" id="user{{ $user }}" class="group-user-field" name="group_user_list[]" value=" {{ $user }} ">
                        @endforeach
                    @endif
                <input type="submit" value="Create Group" class="btn btn-success">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-4 mb-4">
            <div class="row bg-light" style="height:250px;">
                <div class="col-12">
                    <table class="table" >
                        <thead>
                        <tr>
                            <th style="width: 30%">Name</th>
                            <th style="width: 55%">Email</th>
                            <th style="width: 15%"></th>
                        </tr>
                        </thead>
                        <tbody id="results">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <form id="searchUsers" class="form-horizontal">
                        <input id="group_id" type="hidden" value="test">
                        <div class="row">
                            <div class="col-8">
                                <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Search for groupmembers">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4 mb-4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="addedGroupmembers">
                @if($users)
                    @foreach( $users as $user)
                        <tr><td scope="row">{{ $user->name }}</td><td scope="row">{{ $user->email }}</td><td scope="row"><button class="btn btn-sm btn-danger remove-invite-button" value="{{ $user->id }}"><i class="fas fa-user-minus" aria-hidden="true"></i></button></td></tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-4 mb-4">
            <h4>Information</h4>
        </div>

    </div>
@endsection