<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('sessions')->orderBy('name')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create', ['room' => new Room()]);
    }

    public function store(Request $request)
    {
        Room::create($this->validateRoom($request));
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        $room->load(['sessions.speaker', 'sessions.track']);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $room->update($this->validateRoom($request));
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        if ($room->sessions()->exists()) {
            return back()->with('error', 'Cannot delete a room that has sessions.');
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }

    private function validateRoom(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'max:120'],
            'building' => ['required', 'max:120'],
            'capacity' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'max:1000'],
        ]);
    }
}
