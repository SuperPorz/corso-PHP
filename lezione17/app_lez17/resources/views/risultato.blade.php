<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Form</title>
</head>
<body>
    <h3><i>Il risultato di</i> {{ $num1 }} + {{ $num2 }} <i>è:</i></h3>
    <h1>{{ $somma }}</h1>
    <hr>
    @include('blocks.menu')
</body>
</html>