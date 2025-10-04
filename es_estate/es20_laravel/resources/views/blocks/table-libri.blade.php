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
            <td>Azione #2</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($libri as $libro)
            <tr>
                <td>{{ $libro['idl'] }}</td>
                <td>{{ $libro['titolo'] }}</td>
                <td>{{ $libro['autore'] }}</td>
                <td>{{ $libro['genere'] }}</td>
                <td>{{ $libro['dewey'] }}</td>
                <td>{{ $libro['collocazione'] }}</td>
                <td>
                    <form action="{{ url('/admin/edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="modifica">
                        <input type="hidden" name="idl" value="{{ $libro['idl'] }}">
                        <input class="button" type="submit" value="MODIFICA">
                    </form>                    
                </td>
                <td>
                    <form action="{{ url('/admin/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="elimina">
                        <input type="hidden" name="idl" value="{{ $libro['idl'] }}">
                        <input class="button" type="submit" value="ELIMINA">
                    </form>                    
                </td>                
            </tr>            
        @endforeach
    </tbody>
</table>