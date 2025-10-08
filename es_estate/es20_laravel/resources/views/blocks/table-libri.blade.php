<table border="1px">
    <thead>
        <tr>
            <td>ID libro</td>
            <td>Titolo</td>
            <td>Autore</td>
            <td>Genere</td>
            <td>Dewey</td>
            <td>Collocazione</td>
            <td>Azione #1</td>
            @if ($pagina == 'admin/homepage')
                <td>Azione #2</td>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($libri as $libro)
            <tr>
                <td>{{ $libro->idl }}</td>
                <td>{{ $libro->titolo }}</td>
                <td>{{ $libro->autore }}</td>
                <td>{{ $libro->genere }}</td>
                <td>{{ $libro->dewey }}</td>
                <td>{{ $libro->collocazione }}</td>
                @if ($pagina == 'admin/homepage')
                    <td>
                        <form action="{{ url('/admin/edit-book') }}" method="POST">
                            @csrf
                            <input type="hidden" name="azione" value="modifica">
                            <input type="hidden" name="idl" value="{{ $libro->idl }}">
                            <input class="button" type="submit" value="MODIFICA">
                        </form>                    
                    </td>
                    <td>
                        <form action="{{ url('/admin/delete-book') }}" method="POST">
                            @csrf
                            <input type="hidden" name="azione" value="elimina">
                            <input type="hidden" name="idl" value="{{ $libro->idl }}">
                            <input class="button" type="submit" value="ELIMINA">
                        </form>                    
                    </td>
                @else
                    <td>
                        @if(isset($mostra_termina) && $mostra_termina)
                            <form action="{{ url('/users/return-book') }}" method="POST">
                                @csrf
                                <input type="hidden" name="azione" value="termina">
                                <input type="hidden" name="idp" value="{{ $libro->idp }}">
                                <input type="hidden" name="idu" value="{{ Auth::id() }}">
                                <input type="hidden" name="idl" value="{{ $libro->idl }}">
                                <input class="button" type="submit" value="TERMINA PRESTITO">
                            </form>
                        @else
                            <form action="{{ url('/users/loan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="azione" value="prenota">
                                <input type="hidden" name="idu" value="{{ Auth::id() }}">
                                <input type="hidden" name="idl" value="{{ $libro->idl }}">
                                @if(method_exists($libro, 'isDisponibile') && !$libro->isDisponibile())
                                    <input class="button" type="submit" value="NON DISPONIBILE" disabled>
                                @else
                                    <input class="button" type="submit" value="PRENOTA">
                                @endif
                            </form>
                        @endif
                    </td>
                @endif
            </tr>            
        @endforeach
    </tbody>
</table>