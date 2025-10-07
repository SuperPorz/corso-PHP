<!DOCTYPE html>
<html lang="it">
    @include('blocks.head', ['pageTitle' => $pageTitle, 'metaTitle' => $metaTitle])
    <body>
        <header>
            @include('blocks.nav')
        </header>
        <main>
            @include('blocks.success')
            @include('blocks.errors')

            {{-- MAIN CONTENT --}}
            <div>
                @yield('content')
            </div>
        </main>
    </body>
</html>