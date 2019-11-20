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
            <form id="uploadprofilepicture" class="form-horizontal" method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" id="profilepicture">
                    <small class="error"></small>
                </div>
                <input type="submit" value="Upload Picture" class="btn btn-success">
            </form>
        </div>
        <div class="col-4 mt-3">
            <h5>Information about me</h5>
        </div>
        <div class="col-4 mt-3">
            <h5>My Groups</h5>
        </div>
    </div>

@endsection
