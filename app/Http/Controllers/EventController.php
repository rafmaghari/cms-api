<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function currentEvents()
    {
        $events = Event::where('event_date', now()->format('Y-m-d'))->get();

        return EventResource::collection($events);
    }
}
