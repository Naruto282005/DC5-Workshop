<?php

use Illuminate\Support\Facades\Route;
use App\Models\Workshop;

Route::get('/workshops', function () {
    return Workshop::selectRaw("
        id,
        title,
        speaker,
        venue,
        event_date as date,
        start_time,
        end_time,
        capacity,
        status
    ")
    ->orderBy('event_date', 'asc')
    ->get();
})->name('api.workshops.index');
