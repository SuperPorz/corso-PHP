<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('img/library.svg') }}" alt="Bootstrap" width="80" height="60">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav flex-grow-1">
                <a class="nav-link active" href="{{ url('/users/homepage')}}">Home</a>
                <a class="nav-link active" href="{{ url('/users/search')}}">Cerca</a>
                <a class="nav-link active" href="{{ url('/users/loans')}}">Prestiti</a>
                <a class="nav-link active" href="{{ url('/users/stored-books')}}">Elenco</a>
            </div>
            <div class="d-flex btn-group">
                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Logout</button>
                </form>
                @else
                <a type="button" class="btn btn-secondary" href="{{ route('login') }}">Accedi</a>
                <a type="button" class="btn btn-primary" href="{{ route('usreg') }}">Registrati</a>
                @endauth
            </div>
        </div>
    </div>
</nav>