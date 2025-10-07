@extends('layouts.main')

@section('content')
    <hr>
    <h1>{{ $h1 }}</h1>
    <h3>{{ $h3 }}</h3>
    @include('blocks.form')
    <hr>
    <h3>Se non sei iscritto, registrati:</h3>
    <a href="register">Clicca qui per registrati</a>
@endsection