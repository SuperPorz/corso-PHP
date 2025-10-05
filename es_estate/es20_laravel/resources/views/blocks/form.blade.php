@if ($azione == 'login' && ($user_type == 'admin' || $user_type == 'users'))
    <form action="{{ url("/{$pagina}") }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required>

        <label for="password">Password</label>
        <input type="text" name="password" required>

        <input type="submit" value="ACCEDI">
    </form>
@else
    <form action="{{ url("/{$pagina}") }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="password">Password</label>
        <input type="text" name="password" required>

        <input type="submit" value="REGISTRATI">
    </form>
@endif