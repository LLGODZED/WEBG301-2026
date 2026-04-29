<?php

namespace App\Http\Controllers;

use App\Models\ConferenceSession;
use App\Models\Registration;
use App\Services\ScheduleConflictService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request, ConferenceSession $session, ScheduleConflictService $conflicts)
    {
        $user = $request->user();

        if ($session->is_full) {
            return back()->with('error', 'This session is full.');
        }

        if ($conflicts->userHasConflict($user, $session)) {
            return back()->with('error', 'You already registered for another session at this time.');
        }

        Registration::updateOrCreate(
            ['user_id' => $user->id, 'conference_session_id' => $session->id],
            ['status' => 'registered']
        );

        return back()->with('success', 'Session registered successfully.');
    }

    public function destroy(Request $request, ConferenceSession $session)
    {
        Registration::where('user_id', $request->user()->id)
            ->where('conference_session_id', $session->id)
            ->delete();

        return back()->with('success', 'Registration cancelled.');
    }
}
