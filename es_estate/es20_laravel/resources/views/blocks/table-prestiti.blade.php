<table class="table table-sm table-striped table-hover align-middle">
    <thead>
        <tr>
            <th scope="col">ID prestito</th>
            <th scope="col">Titolo libro</th>
            <th scope="col">Genere libro</th>
            <th scope="col">Nome lettore</th>
            <th scope="col">Email lettore</th>
            <th scope="col">Inizio prestito</th>
            <th scope="col">Scadenza</th>
            <th scope="col">Fine prestito</th>
            <th scope="col">Azione #1</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prestiti as $prestito)
            <tr scope="row">
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
                        <input class="btn btn-danger btn-sm" type="submit" value="ELIMINA PRESTITO">
                    </form>                    
                </td>                
            </tr>            
        @endforeach
    </tbody>
</table>