@extends('layouts.main')

@section('content')
<div class="container-xxl text-center gy-5">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Elenco Libri della biblioteca</h1>
        </div>
    </div>

    {{-- sezione - prima tabella--}}
    <div class="row">
        <div class="col">
            <h2>Libri ordinati per GENERE:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col overflow-scroll" style="height:400px;">
            @include('blocks.table-libri', ['libri' => $libri_genere])           
        </div>
    </div>

    {{-- sezione accordion 2 - seconda tabella--}}
    <div class="row">
        <div class="col">
            <h2>Libri ordinati per AUTORE:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col overflow-scroll" style="height:400px;">
            @include('blocks.table-libri', ['libri' => $libri_autore])
        </div>
    </div>
</div>
@endsection

@php
$pageTitle = 'Elenco Libri';
$metaTitle = 'Elenco Libri';
@endphp