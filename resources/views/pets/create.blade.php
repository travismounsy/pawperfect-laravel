<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet | PawPerfect</title>
</head>
<body>
    <h1>Add a Pet</h1>

    <form action="{{ route('pets.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Pet name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                maxlength="255"
                required
            >

            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="species">Species</label>
            <select id="species" name="species" required>
                <option value="">Choose a species</option>

                @foreach (['Dog', 'Cat', 'Other'] as $species)
                    <option
                        value="{{ $species }}"
                        @selected(old('species') === $species)
                    >
                        {{ $species }}
                    </option>
                @endforeach
            </select>

            @error('species')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="breed">Breed optional</label>
            <input
                id="breed"
                name="breed"
                type="text"
                value="{{ old('breed') }}"
                maxlength="255"
            >

            @error('breed')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Save Pet</button>
    </form>

    <p><a href="{{ route('pets.index') }}">Cancel</a></p>
</body>
</html>