@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE ADMIN</h1>
    <h3>Inserisci nuovo libro</h3>
    @include('blocks.form-libro')
    <hr>
    <h3>Collezione biblioteca:</h3>
    @include('blocks.table-libri')
@endsection

@php
$pageTitle = 'Admin';
$metaTitle = 'Homepage Admnin';
@endphp