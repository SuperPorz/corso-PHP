<!DOCTYPE html>
<html lang="it">
    @include('blocks.head', ['pageTitle' => $pageTitle, 'metaTitle' => $metaTitle])
    <body>
        <header>
            @include('blocks.nav')
        </header>
        <main>
            <div>
                @yield('content')
            </div>
        </main>
    </body>
</html>