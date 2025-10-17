@extends('layouts.main')

@section('content')
<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Prestiti Attivi Utente</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Prestiti attivi dell'utente: <mark><i>{{ auth()->user()->name }}</i></mark></h3>
            @include('blocks.table-libri-utente', ['libri' => $libri_user])
        </div>
    </div>

</div>
@endsection

@php
$pageTitle = 'Prestiti Utente';
$metaTitle = 'Prestiti Utente';
@endphp