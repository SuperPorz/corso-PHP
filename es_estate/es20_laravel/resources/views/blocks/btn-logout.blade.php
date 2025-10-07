{{-- tasto logout --}}
@auth
    <form action="{{ route('uslogout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
{{-- @else
    <a href="{{ route('uslogin') }}">Login</a> --}}
@endauth