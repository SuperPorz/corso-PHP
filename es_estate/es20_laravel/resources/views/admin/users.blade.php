@extends('layouts.main')

@section('content')
<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Gestione Utenti</h1>
            <hr>
        </div>
    </div>

    {{-- SEZIONE TABELLA UTENTI --}}
    <div class="row">
        <div class="col">
            <h3>Utenti registrati:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('blocks.table-users')
        </div>
    </div>

    {{-- SEZIONE BOTTONI --}}
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="{{ url('/admin/database')}}" role="button">Database</a>
            <a class="btn btn-primary" href="{{ url('/admin/edit-users')}}" role="button">Gestione Utenti</a>
            <a class="btn btn-primary" href="{{ url('/admin/loans-list')}}" role="button">Elenco Prestiti</a>
            <a class="btn btn-primary" href="{{ url('/admin/expired-loans')}}" role="button">Prestiti Scaduti</a>
            <a class="btn btn-primary" href="{{ url('/admin/populate')}}" role="button">Popola Database</a>
        </div>
    </div>
</div>
@endsection