@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="col-12 mt-3">
        <div class="row">
            <div class="col-12 mt-3">
                <h3>Edit group</h3>

                <form class="form-horizontal" method="POST" action="{{ route('group_update', ['group_id' => $group_id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Group name</label>
                        <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="{{ old('name',$name) }}">
                        <small class="error">{{$errors->first('name')}}</small>
                    </div>
                    <div class="form-group">
                        <label>Beschrijving</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description',$description) }}">
                        <small class="error">{{$errors->first('description')}}</small>
                    </div>
                    <div class="form-group">
                        <label>Deadline Datum</label>
                        <input type="date" class="form-control" name="deadline" value="{{ old('deadline', $deadline) }}">
                        <small class="error">{{$errors->first('deadline')}}</small>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
@endsection