@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE ADMIN</h1>
    <h3>Inserisci nuovo libro</h3>
    @include('blocks.form-libro')
    <hr>
    {{-- importare blocco tabella per i libri --}}
@endsection

@php
$pageTitle = 'Admin';
$metaTitle = 'Homepage Admnin';
@endphp