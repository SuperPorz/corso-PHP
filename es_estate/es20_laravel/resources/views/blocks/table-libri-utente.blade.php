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
            <td>
                <form action="{{ url('/users/return-book') }}" method="POST">
                    @csrf
                    <input type="hidden" name="azione" value="termina">
                    <input type="hidden" name="idp" value="{{ $libro->idp }}">
                    <input type="hidden" name="idu" value="{{ Auth::id() }}">
                    <input type="hidden" name="idl" value="{{ $libro->idl }}">
                    <input class="btn btn-danger btn-sm" type="submit" value="TERMINA PRESTITO">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>