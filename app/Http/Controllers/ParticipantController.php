<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ParticipantController extends Controller
{
    public function index(): Response
    {
        $participants = Participant::latest()->get();

        return Inertia::render('Participants/Index', [
            'participants' => $participants,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Participants/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:50',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        Participant::create($validated);

        return redirect()->route('participants.index')->with('success', 'Participant created successfully.');
    }

    public function edit(Participant $participant): Response
    {
        return Inertia::render('Participants/Edit', [
            'participant' => $participant,
        ]);
    }

    public function update(Request $request, Participant $participant): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('participants', 'email')->ignore($participant->id)],
            'phone' => 'required|string|max:50',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant): RedirectResponse
    {
        $participant->delete();

        return redirect()->route('participants.index')->with('success', 'Participant deleted successfully.');
    }
}
