@extends('layouts.main')

@section('content')
    <h1>LOGIN LETTORI</h1>
    <h3>Accedi alla sezione lettori</h3>
    @include('blocks.form')
@endsection

@php
$pageTitle = 'Login';
$metaTitle = 'Login Lettori';
@endphp