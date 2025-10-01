<form action="{{ url('/lettori') }}" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Password</label>
    <input type="email" name="password" required>

    <input type="submit" value="REGISTRATI">
</form>