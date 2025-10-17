@extends('layouts.main')

@section('content')
<div class="container-xxl text-center">
    <div class="row">
        <div class="col">
            <h1 class="italianno-regular">Elenco Libri della biblioteca</h1>
        </div>
    </div>

    {{-- sezione accordion 1 - prima tabella--}}
    <div class="row">
        <div class="col">

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header text-center">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Libri ordinati per GENERE:
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @include('blocks.table-libri', ['libri' => $libri_genere])

                            {{-- logica di caricamento immagine collocazione libro --}}
                            @if (isset($_GET['azione']))
                            @php
                            $collocazione = $_GET['collocazione'];
                            // Estrae la prima lettera e la porta in minuscolo
                            $prima_parte = strtolower(substr($collocazione, 0, 1));
                            // Estrae l'ultimo numero rimuovendo gli zeri iniziali
                            $parti = explode('.', $collocazione);
                            $ultimo_numero = ltrim(end($parti), '0');
                            // Costruisce il nome dell'immagine nel formato: letteraxnumero
                            $nome_img = $prima_parte . 'x' . $ultimo_numero;
                            @endphp
                            @else
                            @php
                            $nome_img = 'main';
                            @endphp
                            @endif
                            <img class="img-fluid img-thumbnail" width="700px"
                                src="{{ asset('img/' . $nome_img . '.png') }}">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- sezione accordion 2 - seconda tabella--}}
    <div class="row">
        <div class="col">

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Libri ordinati per AUTORE:
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @include('blocks.table-libri', ['libri' => $libri_autore])
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@php
$pageTitle = 'Elenco Libri';
$metaTitle = 'Elenco Libri';
@endphp