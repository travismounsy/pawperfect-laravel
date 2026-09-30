<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service | PawPerfect</title>
</head>
<body>
    <h1>Edit Grooming Service</h1>

    <form action="{{ route('services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Service name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $service->name) }}"
                maxlength="255"
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
                value="{{ old('price', $service->price) }}"
                min="0"
                max="999999.99"
                step="0.01"
                required
            >

            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Service</button>
    </form>

    <p>
        <a href="{{ route('services.index') }}">Cancel</a>
    </p>
</body>
</html>