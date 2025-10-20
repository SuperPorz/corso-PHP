<table class="table table-sm table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID libro</th>
            <th scope="col">Titolo</th>
            <th scope="col">Autore</th>
            <th scope="col">Genere</th>
            <th scope="col">Dewey</th>
            <th scope="col">Collocazione</th>
            <th scope="col">Azione #1</th>
            <th scope="col">Azione #2</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($libri as $libro)
        <tr scope="row">
            <td>{{ $libro->idl }}</td>
            <td>{{ $libro->titolo }}</td>
            <td>{{ $libro->autore }}</td>
            <td>{{ $libro->genere }}</td>
            <td>{{ $libro->dewey }}</td>
            <td>{{ $libro->collocazione }}</td>
            @if ($pagina == 'admin/database')
                <td>
                    <form action="{{ url('/admin/edit-book') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="modifica">
                        <input type="hidden" name="idl" value="{{ $libro->idl }}">
                        <input class="btn btn-primary btn-sm" type="submit" value="MODIFICA">
                    </form>
                </td>
                <td>
                    <form action="{{ url('/admin/delete-book') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="elimina">
                        <input type="hidden" name="idl" value="{{ $libro->idl }}">
                        <input class="btn btn-danger btn-sm" type="submit" value="ELIMINA">
                    </form>
                </td>
            @else
                <td>
                    <form action="{{ url('/users/loan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="prenota">
                        <input type="hidden" name="idu" value="{{ Auth::id() }}">
                        <input type="hidden" name="idl" value="{{ $libro->idl }}">
                        @if(method_exists($libro, 'isDisponibile') && !$libro->isDisponibile())
                        <input class="btn btn-primary btn-sm" type="submit" value="in prestito" disabled>
                        @else
                        <input class="btn btn-primary btn-sm" type="submit" value="PRENOTA">
                        @endif
                    </form>
                </td>
                <td>
                    <form action="" method="GET">
                        <span hidden class="hidden-span">{{ $libro->collocazione }}</span>
                        <input type="hidden" name="azione" value="mostra">
                        <input type="hidden" name="collocazione" value="{{ $libro->collocazione }}">
                        <input class="btn btn-info btn-sm collocazione" type="submit" value="Vedi collocazione">
                    </form>
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>