<table class="table table-sm table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID Utente</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Verificato il</th>
            <th scope="col">Is Admin</th>
            <th scope="col">Azione #1</th>
            <th scope="col">Azione #2</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr scope="row">
                <td>{{ $user['idu'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['email_verified_at'] }}</td>
                <td>{{ $user['is_admin'] }}</td>
                <td>
                    <form action="{{ url('/admin/promote-user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="promuovi">
                        <input type="hidden" name="idu" value="{{ $user['idu'] }}">
                        <input class="btn btn-success btn-sm" type="submit" value="PROMUOVI">
                    </form>                    
                </td>
                <td>
                    <form action="{{ url('/admin/delete-user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="elimina">
                        <input type="hidden" name="idu" value="{{ $user['idu'] }}">
                        <input class="btn btn-danger btn-sm" type="submit" value="ELIMINA">
                    </form>                    
                </td>                
            </tr>            
        @endforeach
    </tbody>
</table>