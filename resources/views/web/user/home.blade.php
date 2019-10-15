@extends('layouts.app')

@section('pageTitle', 'profile')

@section('body_class', 'body')

@section('content')
    <h3>Profiel</h3>
    <p>Hier staat ook nog een beetje onzin</p>
    <p>Jawel, meer onzin</p>
    <p>De gebruiker: '{{ Auth::user()->name }}' is nu ingelogd.</p>
@endsection
