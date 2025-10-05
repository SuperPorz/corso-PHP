@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE UTENTI</h1>
    <h3>Cerca un libro per il prestito:</h3>
    @include('blocks.form-libro')
    <hr>
    <h3>Risultati ricerca:</h3>
    @isset ($libri_match)
        {{-- @php
        $libri = $libri_match;
        @endphp --}}
        @include('blocks.table-libri', ['libri' => $libri_match])
    @endisset
    <hr>
    <h3>Collezione biblioteca:</h3>
    @include('blocks.table-libri')
@endsection

@php
$pageTitle = 'Homepage Utenti';
$metaTitle = 'Homepage Utenti';
@endphp