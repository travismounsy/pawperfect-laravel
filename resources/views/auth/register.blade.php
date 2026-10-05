<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PawPerfect</title>
</head>
<body>
    <h1>Create Your PawPerfect Account</h1>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                autocomplete="name"
                maxlength="255"
                required
            >

            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                maxlength="255"
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
                autocomplete="new-password"
                minlength="8"
                maxlength="72"
                required
            >

            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                required
            >
        </div>

        <button type="submit">Create Account</button>
    </form>

    <p>
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </p>

    <p><a href="{{ route('services.index') }}">Back to services</a></p>
</body>
</html>