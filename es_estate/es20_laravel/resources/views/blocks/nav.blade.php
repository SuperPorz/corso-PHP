<nav>
    <ul>
        <li><a href="{{ url('/')}}">Homepage</a></li><br>
        <li><a href="{{ url('/admin')}}">Admin</a></li><br>
        <li><a href="{{ url('/admin/homepage?pagina="admin/homepage"')}}">HOME Admin (debug)</a></li><br>
        <li><a href="{{ url('/lettori')}}">Lettori</a></li><br>
        <li><a href="{{ url('/create-users')}}">Crea 10 utenti</a></li>
        <li><a href="{{ url('/create-books')}}">Crea 10 libri</a></li>
        <li><a href="{{ url('/create-books-loan')}}">Crea 10 prestiti</a></li>
    </ul>
</nav>