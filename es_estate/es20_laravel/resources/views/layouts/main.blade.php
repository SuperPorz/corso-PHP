<!DOCTYPE html>
<html lang="it">
    @include('blocks.head', ['pageTitle' => $pageTitle, 'metaTitle' => $metaTitle])
    <body>
        <header>
            @auth
                @if (Auth::user()->is_admin)
                    @include('blocks.nav-admin')
                @else
                    @include('blocks.nav-user')
                @endif
            @else
                @include('blocks.nav-user')
            @endauth
        </header>
        @if (isset($data))
            <div class="row" style=" background-color: green">
                <div class="col-12">
                    <pre style="color: white">Inserimento effettuato!</pre>
                </div>
            </div>
        @endif
        <main id="centrale">
            @include('blocks.success')

            {{-- MAIN CONTENT --}}
            @yield('content')

        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>