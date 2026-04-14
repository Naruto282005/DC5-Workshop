<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class RegistrationController extends Controller
{
    public function index(): Response
    {
        $registrations = Registration::with(['workshop', 'participant'])->latest()->get();

        return Inertia::render('Registrations/Index', [
            'registrations' => $registrations,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Registrations/Create', [
            'workshops' => Workshop::orderBy('title')->get(),
            'participants' => Participant::orderBy('first_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'workshop_id' => 'required|exists:workshops,id',
            'participant_id' => 'required|exists:participants,id',
            'registration_date' => 'required|date',
            'payment_status' => 'required|string|max:50',
            'attendance_status' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'participant_id' => [
                'required',
                'exists:participants,id',
                Rule::unique('registrations')->where(function ($query) use ($request) {
                    return $query->where('workshop_id', $request->workshop_id)
                                 ->where('participant_id', $request->participant_id);
                }),
            ],
        ], [
            'participant_id.unique' => 'This participant is already registered in this workshop.',
        ]);

        Registration::create($validated);

        return redirect()->route('registrations.index')->with('success', 'Registration created successfully.');
    }

    public function edit(Registration $registration): Response
    {
        return Inertia::render('Registrations/Edit', [
            'registration' => $registration,
            'workshops' => Workshop::orderBy('title')->get(),
            'participants' => Participant::orderBy('first_name')->get(),
        ]);
    }

    public function update(Request $request, Registration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'workshop_id' => 'required|exists:workshops,id',
            'participant_id' => 'required|exists:participants,id',
            'registration_date' => 'required|date',
            'payment_status' => 'required|string|max:50',
            'attendance_status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $registration->update($validated);

        return redirect()->route('registrations.index')->with('success', 'Registration updated successfully.');
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $registration->delete();

        return redirect()->route('registrations.index')->with('success', 'Registration deleted successfully.');
    }
}
