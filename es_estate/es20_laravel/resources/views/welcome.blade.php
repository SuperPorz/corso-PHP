@extends('layouts.main')

@section('content')
    <div class="container-xxl text-center">
        <div class="row">
            <div class="col-12">
                <h1 class="italianno-regular">Biblioteca La Sapienza di Lorenzoni</h1>
            </div>
        </div>
        @include('blocks.carousel')
        <div class="row">
            <div class="col-12">
                <h1 class="italianno-regular-medium">Welcome...</h1>
            </div>
        </div>
    </div>
@endsection

@php
$pageTitle = 'Homepage';
$metaTitle = 'Homepage dell\'App';
@endphp