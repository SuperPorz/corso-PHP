<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verifica PHP</title>
</head>
<body>

    {{-- sezione 0: titolo --}}
    <h1>RISTORANTE TRATTORIA LARAVELLO</h1>
    <br>

    {{-- sezione 1: inserimento prenotazione --}}
    <section>
        <hr>
        <h2>inserisci una prenotazione</h2>

        <form action="#" method="POST">
            @csrf

            <input type="date" name="data_prenotazione" value="" required>
            <input type="text" name="nominativo" required>
            <input type="submit">
        </form>

        <hr>
        <h2>elenco prenotazioni:</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">ID prenotazione</th>
                    <th scope="col">Data</th>
                    <th scope="col">Nominativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prenotazioni as $prenotazione)
                <tr scope="row">
                    <td>{{ $prenotazione->id_prenotazione }}</td>
                    <td>{{ $prenotazione->data_prenotazione }}</td>
                    <td>{{ $prenotazione->nominativo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </section>

    {{-- sezione 2: selezione data e invio: visualizzazione lista ingredienti --}}
    <section>
        <hr>
        <h2>Controlla lista ingredienti giornaliera</h2>

        <form action="{{ route('controlla_ingredienti') }}" method="POST">
            @csrf
            <input type="date" name="data_prenotazione" required>
            <input type="submit" value="Controlla">
        </form>

        <table>
            <thead>
                <tr>
                    <th scope="col">Data selezionata</th>
                    <th scope="col">Ingrediente</th>
                    <th scope="col">Quantità</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($ingredienti) && $ingredienti->count() > 0)
                    @foreach ($ingredienti as $item)
                    <tr>
                        <td>{{ $item->data_selezionata }}</td>
                        <td>{{ $item->ingrediente }}</td>
                        <td>{{ $item->quantita_totale }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">Nessun dato disponibile per la data selezionata</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </section>
    
</body>
</html>
