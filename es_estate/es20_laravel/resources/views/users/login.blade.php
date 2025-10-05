@extends('layouts.main')

@section('content')
    <hr>
    <h1>LOGIN LETTORI</h1>
    <h3>Accedi alla sezione lettori</h3>
    @include('blocks.form')
    <hr>
    <h3>Se non sei iscritto, registrati:</h3>
    <a href="users/register">Clicca qui per registrarti</a>
@endsection

@php
$pageTitle = 'Login Lettori';
$metaTitle = 'Login Lettori';
@endphp