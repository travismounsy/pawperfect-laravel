<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PawPerfect Pet Grooming</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 800px;
                margin: 40px auto;
                padding: 0 20px;
                background: #f5f7fa;
                color: #243040;
            }

            .service {
                background: white;
                padding: 20px;
                margin-bottom: 16px;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <h1>PawPerfect Pet Grooming</h1>
        <p>Keep your pets looking and feeling their best.</p>

        <p>
        <a href="{{ route('services.create') }}">Add a service</a>
        </p>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
            <h2>Our Services</h2>

        @foreach ($services as $service)
            <div class="service">
                <h3>{{ $service->name }}</h3>
                <p>Price: ${{ number_format($service->price, 2) }}</p>
                <a href="{{ route('services.edit', $service) }}">Edit</a>
                <form
                    action="{{ route('services.destroy', $service) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this service?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach

        @auth
        <p>Welcome, {{ auth()->user()->name }}!</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @else
            <p><a href="{{ route('login') }}">Login</a></p>
        @endauth
    </body>
</html>