@extends('layouts.main')

@section('content')
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
        <h3>Prestiti scaduti:</h3>
        {{-- blocco per caricare i prestiti scaduti --}}
    @endif
@endsection

@php
$pageTitle = 'Admin';
$metaTitle = 'Homepage Admin';
@endphp