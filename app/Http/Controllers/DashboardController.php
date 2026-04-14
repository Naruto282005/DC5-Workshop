<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\Workshop;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
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
