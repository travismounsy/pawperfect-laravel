<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController extends Controller
{
    public function index(Request $request): View
    {
        $pets = $request->user()
            ->pets()
            ->orderBy('name')
            ->get();

        return view('pets.index', ['pets' => $pets]);
    }

    public function create(): View
    {
        return view('pets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'in:Dog,Cat,Other'],
            'breed' => ['nullable', 'string', 'max:255'],
        ]);

        $request->user()->pets()->create($validated);

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet added successfully!');
    }
}