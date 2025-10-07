@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif