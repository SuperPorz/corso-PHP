@extends('layouts.main')

@section('content')
    <h1>HOMEPAGE</h1>
    <h3>Benvenuto!!!</h3>
    @if (isset($data))
        {{-- {{ print_r($data) }} --}} {{-- esce troppo schifo --}}
        <div style="background-color: green">
            <pre style="color: white">Inserimento effettuato!</pre>
        </div>
    @endif
@endsection

@php
$pageTitle = 'Homepage';
$metaTitle = 'Homepage dell\'App';
@endphp