<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSession;

class ScheduleApiController extends Controller
{
    public function index()
    {
        $sessions = ConferenceSession::with(['room', 'speaker', 'track'])
            ->where('status', 'published')
            ->orderBy('start_time')
            ->get()
            ->map(function ($session) {
                return [
                    'id' => $session->id,
                    'title' => $session->title,
                    'description' => $session->description,
                    'date' => $session->start_time->format('Y-m-d'),
                    'time' => $session->time_label,
                    'start_time' => $session->start_time->toIso8601String(),
                    'end_time' => $session->end_time->toIso8601String(),
                    'level' => $session->level,
                    'room' => optional($session->room)->name,
                    'speaker' => optional($session->speaker)->name,
                    'track' => optional($session->track)->name,
                    'track_color' => optional($session->track)->color,
                    'available_seats' => max(0, $session->max_attendees - $session->registered_count),
                ];
            });

        return response()->json([
            'data' => $sessions,
            'count' => $sessions->count(),
        ]);
    }

    public function show(ConferenceSession $session)
    {
        $session->load(['room', 'speaker', 'track']);

        return response()->json([
            'id' => $session->id,
            'title' => $session->title,
            'description' => $session->description,
            'time' => $session->time_label,
            'room' => optional($session->room)->name,
            'speaker' => optional($session->speaker)->name,
            'track' => optional($session->track)->name,
            'level' => $session->level,
            'status' => $session->status,
        ]);
    }
}
