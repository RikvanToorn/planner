@extends('layouts.app')

@section('pageTitle', 'profile')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <h3>Profile of {{ $user->name }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-4 mt-3">
            <h5>Profile picture:</h5>
            <div class="container">
                <div class="row">

                    <div class="profile-header-container">
                        <div class="profile-header-img">
                            <img class="rounded-circle avatar" src="/storage/avatars/{{ $user->avatar }}" />
                        </div>
                    </div>

                </div>
                <div class="row mt-4">
                    <form action="/profile/updateavatar" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                            <small class="form-text text-muted">{{$errors->first('avatar')}}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4 mt-3">
            <h5>Information about me</h5>
        </div>
        <div class="col-4 mt-3">
            <h5>My Groups</h5>
        </div>
    </div>

@endsection
