@if (!isset($pagina) || $pagina == 'admin/homepage'){{-- rimuovere 2a cond. dopo fine debug --}}
    <form action="{{ url('/admin/insert-book') }}" method="POST">
@elseif ($pagina == 'modifica')
    <form action="{{ url('/admin/edit-book') }}" method="POST">
@elseif ($pagina == 'users/search')
    <form action="{{ url('/users/search') }}" method="POST">
@endif
        @csrf
        <input type="hidden" name="idl" @if (!empty($libro_mod)) value="{{ $libro_mod['idl'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>

        <label for="titolo">Titolo</label>
        <input type="text" name="titolo" @if (!empty($libro_mod)) value="{{ $libro_mod['titolo'] }}"@endif @if ($pagina == 'admin/homepage') required @endif><br><br>
        
        <label for="autore">Autore</label>
        <input type="text" name="autore" @if (!empty($libro_mod)) value="{{ $libro_mod['autore'] }}"@endif @if ($pagina == 'admin/homepage') required @endif><br><br>

        <label for="genere">Genere</label>
        <input type="text" name="genere" @if (!empty($libro_mod)) value="{{ $libro_mod['genere'] }}"@endif @if ($pagina == 'admin/homepage') required @endif><br><br>

        <label for="dewey">Class. Dewey</label>
        <input type="text" name="dewey" @if (!empty($libro_mod)) value="{{ $libro_mod['dewey'] }}"@endif @if ($pagina == 'admin/homepage') required @endif><br><br>

        <label for="collocazione">Collocazione</label>
        <input type="text" name="collocazione" @if (!empty($libro_mod)) value="{{ $libro_mod['collocazione'] }}"@endif @if ($pagina == 'admin/homepage') required @endif><br><br>

        <input type="submit" value="INSERISCI LIBRO">
    </form>