<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('img/library.svg') }}" alt="Bootstrap" width="80" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav flex-grow-1">
                <a class="nav-link active" href="{{ url('/admin/homepage')}}">Home</a>
                <a class="nav-link" href="{{ url('/admin/database')}}">Database</a>
                <a class="nav-link" href="{{ url('/admin/users')}}">Gestione Utenti</a>
                <a class="nav-link" href="{{ url('/admin/loans-list')}}">Elenco Prestiti</a>
                <a class="nav-link" href="{{ url('/admin/expired-loans')}}">Prestiti Scaduti</a>
                <a class="nav-link" href="{{ url('/admin/populate')}}">Popola Database</a>
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