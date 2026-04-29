<?php

namespace App\Http\Controllers;

use App\Models\ConferenceSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $mySessions = $user->sessions()
            ->with(['room', 'speaker', 'track'])
            ->orderBy('start_time')
            ->get();

        $suggestedSessions = ConferenceSession::with(['room', 'speaker', 'track'])
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        return view('dashboard', compact('mySessions', 'suggestedSessions'));
    }
}
