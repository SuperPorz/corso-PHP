@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE UTENTI</h1>
    <h3>Cerca un libro per il prestito:</h3>
    @include('blocks.form-libro')
    <hr>
    <h3>Risultati ricerca:</h3>
    @isset ($libri_match)
        @include('blocks.table-libri', ['libri' => $libri_match])
    @endisset
    <hr>
@endsection

@php
$pageTitle = 'Cerca Libro';
$metaTitle = 'Cerca Libro';
@endphp