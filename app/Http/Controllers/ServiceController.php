<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('name')->get();

        return view('home', ['services' => $services]);
    }

    public function create(): View
    {
        return view('services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
        ]);

        Service::create($validated);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service added successfully!');
    }

public function edit(Service $service): View
{
    return view('services.edit', ['service' => $service]);
}
public function update(Request $request, Service $service): RedirectResponse
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
    ]);

    $service->update($validated);

    return redirect()
        ->route('services.index')
        ->with('success', 'Service updated successfully!');
}
public function destroy(Service $service): RedirectResponse
{
    $service->delete();

    return redirect()
        ->route('services.index')
        ->with('success', 'Service deleted successfully!');
}
}