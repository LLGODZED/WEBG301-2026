<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::withCount('sessions')->orderBy('name')->paginate(10);
        return view('admin.tracks.index', compact('tracks'));
    }

    public function create()
    {
        return view('admin.tracks.create', ['track' => new Track()]);
    }

    public function store(Request $request)
    {
        Track::create($this->validateTrack($request));
        return redirect()->route('admin.tracks.index')->with('success', 'Track created successfully.');
    }

    public function show(Track $track)
    {
        $track->load(['sessions.room', 'sessions.speaker']);
        return view('admin.tracks.show', compact('track'));
    }

    public function edit(Track $track)
    {
        return view('admin.tracks.edit', compact('track'));
    }

    public function update(Request $request, Track $track)
    {
        $track->update($this->validateTrack($request));
        return redirect()->route('admin.tracks.index')->with('success', 'Track updated successfully.');
    }

    public function destroy(Track $track)
    {
        if ($track->sessions()->exists()) {
            return back()->with('error', 'Cannot delete a track that has sessions.');
        }
        $track->delete();
        return redirect()->route('admin.tracks.index')->with('success', 'Track deleted successfully.');
    }

    private function validateTrack(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'max:120'],
            'color' => ['required', 'max:30'],
            'description' => ['nullable', 'max:1000'],
        ]);
    }
}
