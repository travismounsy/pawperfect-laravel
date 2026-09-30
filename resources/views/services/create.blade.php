<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service | PawPerfect</title>
</head>
<body>
    <h1>Add a Grooming Service</h1>

    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Service name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
            >

            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">Price</label>
            <input
                id="price"
                name="price"
                type="number"
                min="0"
                max="999999.99"
                step="0.01"
                value="{{ old('price') }}"
                required
            >

            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Save Service</button>
    </form>

    <p><a href="{{ route('services.index') }}">Back to services</a></p>
</body>
</html>