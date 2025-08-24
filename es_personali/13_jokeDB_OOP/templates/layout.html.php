<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/jokes.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$title?></title>
    </head>
    <body>
        <header>
            <h1>Internet Jokes Database</h1>
        </header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?action=list">Jokes list</a></li>
                <li><a href="index.php?action=edit">Add a new joke</a></li>
            </ul>
        </nav>
        <main>
            <p><?=$output?></p>
        </main>
        <footer>
            &copy; PHP_STEGA
        </footer>
    </body>
</html>