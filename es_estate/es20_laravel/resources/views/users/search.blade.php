@extends('layouts.main')

@section('content')
<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Ricerca libri</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @include('blocks.form-libro')
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Risultati ricerca:</h3>
            @isset ($libri_match)
                @include('blocks.table-libri', ['libri' => $libri_match])
            @endisset
            <hr>
        </div>
    </div>
</div>
@endsection

@php
$pageTitle = 'Cerca Libro';
$metaTitle = 'Cerca Libro';
@endphp