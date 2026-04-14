<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Participant;
use App\Models\Registration;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'stats' => [
                'workshops' => Workshop::count(),
                'participants' => Participant::count(),
                'registrations' => Registration::count(),
            ],
        ]);
    }
}
