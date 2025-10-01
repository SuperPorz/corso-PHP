<form action="{{ url('/admin-home') }}" method="POST">
    <label for="titolo">Titolo</label>
    <input type="text" name="titolo" required>
    
    <label for="autore">Autore</label>
    <input type="text" name="autore" required>

    <label for="genere">Genere</label>
    <input type="text" name="genere" required>

    <label for="dewey">Class. Dewey</label>
    <input type="text" name="dewey" required>

    <label for="collocazione">Collocazione</label>
    <input type="text" name="collocazione" required>

    <input type="submit" value="INSERISCI LIBRO">
</form>