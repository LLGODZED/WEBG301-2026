<?php

namespace App\Services;

use App\Models\ConferenceSession;
use App\Models\User;

class ScheduleConflictService
{
    public function roomHasConflict($roomId, $startTime, $endTime, $ignoreSessionId = null)
    {
        return ConferenceSession::where('room_id', $roomId)
            ->when($ignoreSessionId, function ($query) use ($ignoreSessionId) {
                return $query->where('id', '!=', $ignoreSessionId);
            })
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();
    }

    public function speakerHasConflict($speakerId, $startTime, $endTime, $ignoreSessionId = null)
    {
        return ConferenceSession::where('speaker_id', $speakerId)
            ->when($ignoreSessionId, function ($query) use ($ignoreSessionId) {
                return $query->where('id', '!=', $ignoreSessionId);
            })
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();
    }

    public function userHasConflict(User $user, ConferenceSession $session)
    {
        return $user->sessions()
            ->where('registrations.status', 'registered')
            ->where('conference_sessions.id', '!=', $session->id)
            ->where('conference_sessions.start_time', '<', $session->end_time)
            ->where('conference_sessions.end_time', '>', $session->start_time)
            ->exists();
    }
}
