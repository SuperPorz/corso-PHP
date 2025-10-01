@extends('layouts.main')

@section('content')
    <h1>PAGINA ADMIN</h1>
    <h3>Accedi alla dashboard di controllo</h3>
    @include('blocks.form')
@endsection

@php
$pageTitle = 'Admin';
$metaTitle = 'Accesso Admin';
@endphp