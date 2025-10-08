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
                <td>
                    <form action="{{ url('/users/return-book') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="termina">
                        <input type="hidden" name="idp" value="{{ $libro->idp }}">
                        <input type="hidden" name="idu" value="{{ Auth::id() }}">
                        <input type="hidden" name="idl" value="{{ $libro->idl }}">
                        <input class="button" type="submit" value="TERMINA PRESTITO">
                    </form>
                </td>
            </tr>            
        @endforeach
    </tbody>
</table>