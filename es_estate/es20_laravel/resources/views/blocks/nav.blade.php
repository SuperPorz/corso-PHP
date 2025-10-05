<nav>
    <ul>
        <li><a href="{{ url('/')}}">Homepage</a></li><br>
        <li><a href="{{ url('/admin')}}">Admin</a></li><br>
        <li><a href="{{ url('/admin/homepage?pagina="admin/homepage"')}}">HOME Admin (debug)</a></li><br>
        <li><a href="{{ url('/users')}}">Utenti</a></li><br>
        <li><a href="{{ url('/users/homepage')}}">HOME Users (debug)</a></li><br>
        <li><a href="{{ url('/populate')}}">Popola Database (users/libri/prestiti)</a></li>
    </ul>
</nav>