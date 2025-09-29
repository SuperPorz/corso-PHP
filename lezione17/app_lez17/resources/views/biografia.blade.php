<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biografia di: {{ $name }}</title>
</head>
<body>
    <h1>Biografia di: {{ $name }}</h1>
    <p>{{ $biografie[$name] }}</p>
    <hr>
    @include('blocks.menu')
</body>
</html>