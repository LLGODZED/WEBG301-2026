<?php

namespace App\Http\Controllers;

use App\Models\ConferenceSession;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Track;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingSessions = ConferenceSession::with(['room', 'speaker', 'track'])
            ->where('start_time', '>=', now()->subDay())
            ->orderBy('start_time')
            ->limit(4)
            ->get();

        return view('home', [
            'sessionCount' => ConferenceSession::count(),
            'roomCount' => Room::count(),
            'speakerCount' => Speaker::count(),
            'trackCount' => Track::count(),
            'upcomingSessions' => $upcomingSessions,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function apiDemo()
    {
        return view('api-demo');
    }
}
