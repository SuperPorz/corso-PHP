<table border="1px">
    <thead>
        <tr>
            <td>ID Utente</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Verificato il</td>
            <td>Is Admin</td>
            <td>Azione #1</td>
            <td>Azione #2</td>
            <td>Azione #3</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user['idu'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['email_verified_at'] }}</td>
                <td>{{ $user['is_admin'] }}</td>
                <td>
                    <form action="{{ url('/admin/promote') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="promuovi">
                        <input type="hidden" name="idu" value="{{ $user['idu'] }}">
                        <input class="button" type="submit" value="PROMUOVI">
                    </form>                    
                </td>
                <td>
                    <form action="{{ url('/admin/edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="modifica">
                        <input type="hidden" name="idu" value="{{ $user['idu'] }}">
                        <input class="button" type="submit" value="MODIFICA">
                    </form>                    
                </td>
                <td>
                    <form action="{{ url('/admin/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="azione" value="elimina">
                        <input type="hidden" name="idu" value="{{ $user['idu'] }}">
                        <input class="button" type="submit" value="ELIMINA">
                    </form>                    
                </td>                
            </tr>            
        @endforeach
    </tbody>
</table>