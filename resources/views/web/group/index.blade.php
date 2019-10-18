@extends('layouts.app')

@section('pageTitle', '   group')

@section('body_class', 'body')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-9 mt-3">
                    <h3>Your groups:</h3>
                </div>
                <div class="col-3">
                    <a class="btn btn-info p-2 right ml-4" href="{{  route('group_new') }}">Nieuwe groep</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Namen</th>
                    <th scope="col">Beschrijving</th>
                    <th scope="col">Deadline</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($groups as $group)
                    <tr>
                        <td scope="row">{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td>{{ $group->deadline }}</td>
                        <td>
                            <a class="btn btn-warning p-2 px-4 right ml-4" href="{{  route('group_show', ['group_id' => $group->id]) }}">Show</a>
                            <a class="btn btn-warning p-2 px-4 right ml-4" href="{{  route('group_modify', ['group_id' => $group->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection