@extends('layouts.main')

@section('content')
<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Homepage Utenti</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col col-lg-4"></div>
        <div class="col col-md-auto text-start">
            <h2>Profilo Utente Loggato</h2>
            <h3>ID: <i>{{ auth()->user()->idu }}</i></h3>
            <h3>Nome: <i>{{ auth()->user()->name }}</i></h3>
            <h3>Email: <i>{{ auth()->user()->email }}</i></h3>
        </div>
        <div class="col col-lg-4"></div>
    </div>
</div>

<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <hr>
            <h2>Seleziona una delle seguenti aree utente:</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col col-lg-4"></div>

        <div class="col col-md-auto text-center">
            <a class="btn btn-primary" href="{{ route('welcome') }}" role="button">Welcome</a>
            <a class="btn btn-primary" href="{{ url('/users/search') }}" role="button">Cerca libro</a>
            <a class="btn btn-primary" href="{{ url('/users/loans') }}" role="button">Prestiti attivi</a>
            <a class="btn btn-primary" href="{{ url('/users/stored-books') }}" role="button">Elenco libri</a>
        </div>

        <div class="col col-lg-4"></div>
    </div>
</div>
@endsection

@php
$pageTitle = 'Homepage Utenti';
$metaTitle = 'Homepage Utenti';
@endphp