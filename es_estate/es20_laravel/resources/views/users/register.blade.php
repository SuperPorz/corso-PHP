@extends('layouts.main')

@section('content')
    <hr>
    <h1>REGISTRAZIONE UTENTI</h1>
    <h3>Compila i campi per registrarti:</h3>
    @include('blocks.form')
    <hr>
@endsection

@php
$pageTitle = 'Registrazione Utenti';
$metaTitle = 'Registrazione Utenti';
@endphp