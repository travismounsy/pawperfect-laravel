<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pets | PawPerfect</title>
</head>
<body>
    <h1>My Pets</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('pets.create') }}">Add a pet</a></p>

    @forelse ($pets as $pet)
        <div>
            <h2>{{ $pet->name }}</h2>
            <p>Species: {{ $pet->species }}</p>
            <p>Breed: {{ $pet->breed ?? 'Not provided' }}</p>
        </div>
    @empty
        <p>You haven’t added any pets yet.</p>
    @endforelse

    <p><a href="{{ route('services.index') }}">Back to services</a></p>
</body>
</html>