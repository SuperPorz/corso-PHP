<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista</title>
</head>
<body>
    <ul>
        @foreach ($lista as $item)
            <li><a href="{{ url('/lista/'. $item) }}">{{ $item }}</a></li>
        @endforeach
    </ul>
    <hr>
    @include('blocks.menu')
</body>
</html>