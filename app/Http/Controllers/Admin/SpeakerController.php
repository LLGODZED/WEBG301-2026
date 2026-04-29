<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::withCount('sessions')->orderBy('name')->paginate(10);
        return view('admin.speakers.index', compact('speakers'));
    }

    public function create()
    {
        return view('admin.speakers.create', ['speaker' => new Speaker()]);
    }

    public function store(Request $request)
    {
        Speaker::create($this->validateSpeaker($request));
        return redirect()->route('admin.speakers.index')->with('success', 'Speaker created successfully.');
    }

    public function show(Speaker $speaker)
    {
        $speaker->load(['sessions.room', 'sessions.track']);
        return view('admin.speakers.show', compact('speaker'));
    }

    public function edit(Speaker $speaker)
    {
        return view('admin.speakers.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker)
    {
        $speaker->update($this->validateSpeaker($request));
        return redirect()->route('admin.speakers.index')->with('success', 'Speaker updated successfully.');
    }

    public function destroy(Speaker $speaker)
    {
        if ($speaker->sessions()->exists()) {
            return back()->with('error', 'Cannot delete a speaker that has sessions.');
        }
        $speaker->delete();
        return redirect()->route('admin.speakers.index')->with('success', 'Speaker deleted successfully.');
    }

    private function validateSpeaker(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'max:50'],
            'bio' => ['nullable', 'max:2000'],
        ]);
    }
}
