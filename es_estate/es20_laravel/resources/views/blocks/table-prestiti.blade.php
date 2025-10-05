<table border="1px">
    <thead>
        <tr>
            <td>ID prestito</td>
            <td>Titolo libro</td>
            <td>Genere libro</td>
            <td>Nome lettore</td>
            <td>Email lettore</td>
            <td>Inizio prestito</td>
            <td>Scadenza</td>
            <td>Fine prestito</td>
            <td>Azione #1</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($prestiti as $prestito)
            <tr>
                <td>{{ $prestito->idp }}</td>
                <td>{{ $prestito->titolo }}</td>
                <td>{{ $prestito->genere }}</td>
                <td>{{ $prestito->name }}</td>
                <td>{{ $prestito->email }}</td>
                <td>{{ $prestito->inizio_prestito }}</td>
                <td>{{ $prestito->scadenza }}</td>
                <td>{{ $prestito->fine_prestito }}</td>                
                <td>
                    <form action="{{ url('/admin/delete-loan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="elimina">
                        <input type="hidden" name="idp" value="{{ $prestito->idp }}">
                        <input class="button" type="submit" value="ELIMINA PRESTITO">
                    </form>                    
                </td>                
            </tr>            
        @endforeach
    </tbody>
</table>