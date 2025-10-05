@extends('layouts.main')

@section('content')
    <hr>
    <h1>REGISTRAZIONE LETTORI</h1>
    <h3>Compila i campi per registrarti alla biblioteca</h3>
    @include('blocks.form')
    <hr>
@endsection

@php
$pageTitle = 'Registrazione Lettori';
$metaTitle = 'Registrazione Lettori';
@endphp