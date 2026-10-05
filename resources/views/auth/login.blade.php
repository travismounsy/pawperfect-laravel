<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PawPerfect</title>
</head>
<body>
    <h1>Login to PawPerfect</h1>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="username"
                required
            >

            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
            >

            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Login</button>
    </form>

    <p><a href="{{ route('services.index') }}">Back to services</a></p>

    <p>New to PawPerfect?<a href="{{ route('register') }}">Create an account</a>
</p>
</body>
</html>