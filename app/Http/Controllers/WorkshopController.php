<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class WorkshopController extends Controller
{
    public function index(): Response
    {
        $workshops = Workshop::latest()->get();

        return Inertia::render('Workshops/Index', [
            'workshops' => $workshops,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Workshops/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        Workshop::create($validated);

        return to_route('workshops.index')->with('success', 'Workshop created successfully.');
    }

    public function edit(Workshop $workshop): Response
    {
        return Inertia::render('Workshops/Edit', [
            'workshop' => $workshop,
        ]);
    }

    public function update(Request $request, Workshop $workshop): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        $workshop->update($validated);

        return to_route('workshops.index')->with('success', 'Workshop updated successfully.');
    }

    public function destroy(Workshop $workshop): RedirectResponse
    {
        $workshop->delete();

        return to_route('workshops.index')->with('success', 'Workshop deleted successfully.');
    }
}
