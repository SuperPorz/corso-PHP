@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE UTENTI</h1>
    <h3>Prestiti attivi dell'utente: <mark><i>{{ auth()->user()->name }}</i></mark></h3>
    @include('blocks.table-libri-utente', ['libri' => $libri_user])
    <hr>
    <h3>Libri ordinati per genere (alfabetico):</h3>
    @include('blocks.table-libri', ['libri' => $libri_genere])

    {{-- logica di caricamento immagine collocazione libro --}}
    @if (isset($_GET['azione']))
        @php
            $collocazione = $_GET['collocazione'];
            // Estrae la prima lettera e la porta in minuscolo
            $prima_parte = strtolower(substr($collocazione, 0, 1));
            // Estrae l'ultimo numero rimuovendo gli zeri iniziali
            $parti = explode('.', $collocazione);
            $ultimo_numero = ltrim(end($parti), '0');
            // Costruisce il nome dell'immagine nel formato: letteraxnumero
            $nome_img = $prima_parte . 'x' . $ultimo_numero;
        @endphp
    @else
        @php
            $nome_img = 'main';
        @endphp
    @endif
        <img class="img-fluid img-thumbnail" width="700px" src="{{ asset('img/' . $nome_img . '.png') }}">

    <hr>
    <h3>Libri ordinati per autore (alfabetico):</h3>
    @include('blocks.table-libri', ['libri' => $libri_autore])
@endsection

@php
$pageTitle = 'Homepage Utenti';
$metaTitle = 'Homepage Utenti';
@endphp