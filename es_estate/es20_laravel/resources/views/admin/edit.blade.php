@extends('layouts.main')

@section('content')
    <h1>MODIFICA LIBRO</h1>
    <h3>Modifica i dati del libro richiamato:</h3>
    @include('blocks.form-libro')
    <hr>
@endsection

@php
$pageTitle = 'Admin - Edit Book';
$metaTitle = 'Edit Book';
@endphp