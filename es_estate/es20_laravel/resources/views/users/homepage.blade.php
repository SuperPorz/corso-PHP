@extends('layouts.main')

@section('content')
    @include('blocks.btn-logout')
    <h1>HOMEPAGE UTENTI</h1>
    <h3>Cerca un libro per il prestito:</h3>
    @include('blocks.form-libro')
    <hr>
    <h3>Risultati ricerca:</h3>
    @isset ($libri_match)
        @include('blocks.table-libri', ['libri' => $libri_match])
    @endisset
    <hr>
    <h3>Prestiti attivi dell'utente: <mark><i>{{ auth()->user()->name }}</i></mark></h3>
    @include('blocks.table-libri', [
        'libri' => $libri_user,
        'mostra_termina' => true
    ])
    <hr>
    <h3>Libri ordinati per genere (alfabetico):</h3>
    @include('blocks.table-libri', ['libri' => $libri_genere])
    <hr>
    <h3>Libri ordinati per autore (alfabetico):</h3>
    @include('blocks.table-libri', ['libri' => $libri_autore])
@endsection

@php
$pageTitle = 'Homepage Utenti';
$metaTitle = 'Homepage Utenti';
@endphp