<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Email sollecito</title>
    </head>
    <body>
        <h1>Egregio/a {{ $user->name }}</h1>
        <p>Con la presente siamo a sollecitare la restituzione del seguente prestito:</p>
        <p>
            <pre>
                ID Prestito: {{ $prestito->idp }}
                ID Libro: {{ $prestito->idl }}
                ID Utente: {{ $prestito->idu }}
                Data Inizio: {{ $prestito->inizio_prestito }}
                Scadenza: {{ $prestito->scadenza }}
                Data Restituzione: "Non ancora restituito"
            </pre>
        </p>
    </body>
</html>