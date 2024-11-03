<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>
