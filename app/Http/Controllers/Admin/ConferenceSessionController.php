<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSession;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Track;
use App\Services\ScheduleConflictService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConferenceSessionController extends Controller
{
    public function index()
    {
        $sessions = ConferenceSession::with(['room', 'speaker', 'track'])
            ->orderBy('start_time')
            ->paginate(10);

        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('admin.sessions.create', $this->formData(new ConferenceSession()));
    }

    public function store(Request $request, ScheduleConflictService $conflicts)
    {
        $data = $this->validateSession($request);
        $this->validateNoConflicts($request, $conflicts);

        ConferenceSession::create($data);
        return redirect()->route('admin.sessions.index')->with('success', 'Session created successfully.');
    }

    public function show(ConferenceSession $session)
    {
        $session->load(['room', 'speaker', 'track', 'registrations.user']);
        return view('admin.sessions.show', compact('session'));
    }

    public function edit(ConferenceSession $session)
    {
        return view('admin.sessions.edit', $this->formData($session));
    }

    public function update(Request $request, ConferenceSession $session, ScheduleConflictService $conflicts)
    {
        $data = $this->validateSession($request);
        $this->validateNoConflicts($request, $conflicts, $session->id);

        $session->update($data);
        return redirect()->route('admin.sessions.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(ConferenceSession $session)
    {
        $session->registrations()->delete();
        $session->delete();

        return redirect()->route('admin.sessions.index')->with('success', 'Session deleted successfully.');
    }

    private function formData(ConferenceSession $session)
    {
        return [
            'session' => $session,
            'rooms' => Room::orderBy('name')->get(),
            'speakers' => Speaker::orderBy('name')->get(),
            'tracks' => Track::orderBy('name')->get(),
            'levels' => ['Beginner', 'Intermediate', 'Advanced'],
            'statuses' => ['draft', 'published', 'cancelled'],
        ];
    }

    private function validateSession(Request $request)
    {
        return $request->validate([
            'title' => ['required', 'max:180'],
            'description' => ['required', 'max:3000'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'level' => ['required', 'max:50'],
            'status' => ['required', 'in:draft,published,cancelled'],
            'room_id' => ['required', 'exists:rooms,id'],
            'speaker_id' => ['required', 'exists:speakers,id'],
            'track_id' => ['required', 'exists:tracks,id'],
            'max_attendees' => ['required', 'integer', 'min:1'],
        ]);
    }

    private function validateNoConflicts(Request $request, ScheduleConflictService $conflicts, $ignoreSessionId = null)
    {
        if ($conflicts->roomHasConflict($request->room_id, $request->start_time, $request->end_time, $ignoreSessionId)) {
            throw ValidationException::withMessages([
                'room_id' => 'Room conflict: this room already has a session in that time range.',
            ]);
        }

        if ($conflicts->speakerHasConflict($request->speaker_id, $request->start_time, $request->end_time, $ignoreSessionId)) {
            throw ValidationException::withMessages([
                'speaker_id' => 'Speaker conflict: this speaker already has a session in that time range.',
            ]);
        }
    }
}
