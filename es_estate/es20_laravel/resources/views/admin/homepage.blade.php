@extends('layouts.main')

@section('content')
    @include('blocks.btn-logout')
    <h1>HOMEPAGE ADMIN</h1>
    <h3>Inserisci nuovo libro</h3>
    @include('blocks.form-libro')
    <hr>
    @if ($pagina == 'admin/homepage')
        <h3>Collezione biblioteca:</h3>
        @include('blocks.table-libri')
        <hr>
        <h3>Utenti registrati:</h3>
        @include('blocks.table-users')
        <hr>
        <h3>Tutti i prestiti:</h3>
        @include('blocks.table-prestiti') 
        <h3>Prestiti scaduti:</h3>
        @include('blocks.table-prestiti-scaduti')
    @endif
@endsection

@php
$pageTitle = 'Admin';
$metaTitle = 'Homepage Admin';
@endphp