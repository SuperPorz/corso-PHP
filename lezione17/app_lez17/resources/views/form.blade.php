<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Submit Form</title>
    </head>
    <body>
        <h1>INSERIMENTO BIOGRAFIE</h1>
        <p>Compila il form:</p>
        <form action="{{ url('/submitted-form') }}" method="POST">
            @csrf
            <label for="name">Nome</label>
            <input type="text" name='name' required>

            <label for="bio">Biografia</label>
            <input type="text" name='bio' required>

            <input type="submit" value="INVIA">
        </form>
        <hr>
        @include('blocks.menu')
    </body>
</html>