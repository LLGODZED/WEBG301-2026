<?php

namespace App\Http\Controllers;

use App\Models\ConferenceSession;
use App\Models\Track;
use Illuminate\Http\Request;

class ConferenceSessionController extends Controller
{
    public function index(Request $request)
    {
        $query = ConferenceSession::with(['room', 'speaker', 'track'])->orderBy('start_time');

        if ($request->filled('track_id')) {
            $query->where('track_id', $request->track_id);
        }

        if ($request->filled('q')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        $sessions = $query->paginate(10)->withQueryString();
        $tracks = Track::orderBy('name')->get();

        return view('sessions.index', compact('sessions', 'tracks'));
    }

    public function show(ConferenceSession $session)
    {
        $session->load(['room', 'speaker', 'track', 'registrations']);
        $isRegistered = auth()->check()
            ? $session->registrations()->where('user_id', auth()->id())->where('status', 'registered')->exists()
            : false;

        return view('sessions.show', compact('session', 'isRegistered'));
    }

    public function timetable()
    {
        $sessions = ConferenceSession::with(['room', 'speaker', 'track'])
            ->orderBy('start_time')
            ->get()
            ->groupBy(function ($session) {
                return $session->start_time->format('Y-m-d');
            });

        return view('sessions.timetable', compact('sessions'));
    }
}
