<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSession;
use App\Models\Registration;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Track;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'sessionCount' => ConferenceSession::count(),
            'registrationCount' => Registration::where('status', 'registered')->count(),
            'roomCount' => Room::count(),
            'speakerCount' => Speaker::count(),
            'trackCount' => Track::count(),
            'userCount' => User::count(),
        ]);
    }
}
