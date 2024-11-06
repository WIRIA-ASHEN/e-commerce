<!DOCTYPE html>
<html>

<head>
    <title>Login - E-commerce</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="form">
            <h1>E-commerce</h1>
            <p>Konnco Studio</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>
