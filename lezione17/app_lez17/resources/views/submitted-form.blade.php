<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Form</title>
</head>
<body>
    <h1>BIOGRAFIA INSERITA:</h1>
    <p>Nome: {{ $name }}</p>
    <p>Biografia: {{ $bio }}</p>
    <hr>
    @include('blocks.menu')
</body>
</html>