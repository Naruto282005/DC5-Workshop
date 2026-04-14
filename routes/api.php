<?php

use App\Http\Controllers\Api\WorkshopApiController;
use Illuminate\Support\Facades\Route;

Route::get('/workshops', [WorkshopApiController::class, 'index'])->name('api.workshops.index');
