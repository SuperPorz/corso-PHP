@if (!isset($pagina) || $pagina == 'admin/homepage')
    <form action="{{ url('/admin/insert') }}" method="POST">
@elseif ($pagina == 'modifica')
    <form action="{{ url('/admin/edit') }}" method="POST">
@endif
        @csrf
        <input type="hidden" name="idl" @if (!empty($libro_mod)) value="{{ $libro_mod['idl'] }}"@endif required>

        <label for="titolo">Titolo</label>
        <input type="text" name="titolo" @if (!empty($libro_mod)) value="{{ $libro_mod['titolo'] }}"@endif required>
        
        <label for="autore">Autore</label>
        <input type="text" name="autore" @if (!empty($libro_mod)) value="{{ $libro_mod['autore'] }}"@endif required>

        <label for="genere">Genere</label>
        <input type="text" name="genere" @if (!empty($libro_mod)) value="{{ $libro_mod['genere'] }}"@endif required>

        <label for="dewey">Class. Dewey</label>
        <input type="text" name="dewey" @if (!empty($libro_mod)) value="{{ $libro_mod['dewey'] }}"@endif required>

        <label for="collocazione">Collocazione</label>
        <input type="text" name="collocazione" @if (!empty($libro_mod)) value="{{ $libro_mod['collocazione'] }}"@endif required>

        <input type="submit" value="INSERISCI LIBRO">
    </form>