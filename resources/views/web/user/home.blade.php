@extends('layouts.app')

@section('pageTitle', 'profile')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <h3>Profile of {{ Auth::user()->name }}</h3>
        </div>
    </div>

@endsection
