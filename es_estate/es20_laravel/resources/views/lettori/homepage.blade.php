@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE LETTORI</h1>
    <h3>Cerca un libro per il prestito:</h3>
    @include('blocks.form-libro')
    <hr>
    {{-- importare blocco tabella per i libri --}}
@endsection

@php
$pageTitle = 'Lettori';
$metaTitle = 'Homepage Lettori';
@endphp