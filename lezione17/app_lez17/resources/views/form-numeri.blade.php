<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Submit Form</title>
    </head>
    <body>
        <h1>INSERIMENTO NUMERI</h1>
        <p>Inserisci due numeri per ottenere la loro somma:</p>
        <form action="{{ url('/risultato') }}" method="POST">
            @csrf
            <label for="num1">Numero 1</label><br>
            <input type="number" name='num1' required><br><br>

            <label for="num2">Numero 2</label><br>
            <input type="number" name='num2' required>

            <input type="submit" value="CALCOLA SOMMA">
        </form>
        <hr>
        @include('blocks.menu')
    </body>
</html>