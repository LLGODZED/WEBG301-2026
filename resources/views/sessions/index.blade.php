@extends('layouts.app')

@section('title', 'Schedule - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <div class="card">
            <h1>Session schedule</h1>
            <form method="GET" class="grid grid-3">
                <div class="form-group">
                    <label>Search</label>
                    <input name="q" value="{{ request('q') }}" placeholder="Search title or description">
                </div>
                <div class="form-group">
                    <label>Track</label>
                    <select name="track_id">
                        <option value="">All tracks</option>
                        @foreach($tracks as $track)
                            <option value="{{ $track->id }}" {{ request('track_id') == $track->id ? 'selected' : '' }}>{{ $track->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="align-self:end;">
                    <button class="btn" type="submit">Filter</button>
                    <a class="btn btn-secondary" href="{{ route('sessions.index') }}">Reset</a>
                </div>
            </form>
        </div>

        <div class="grid grid-2 section">
            @forelse($sessions as $session)
                <article class="card">
                    <span class="badge">{{ $session->track->name ?? 'General' }}</span>
                    <h2><a href="{{ route('sessions.show', $session) }}">{{ $session->title }}</a></h2>
                    <p>{{ Str::limit($session->description, 150) }}</p>
                    <p><strong>{{ $session->date_label }}</strong> · {{ $session->time_label }}</p>
                    <p>Room: {{ $session->room->name ?? '-' }} · Speaker: {{ $session->speaker->name ?? '-' }}</p>
                    <p><span class="badge badge-muted">{{ $session->level }}</span> <span class="badge badge-muted">{{ $session->registered_count }}/{{ $session->max_attendees }} registered</span></p>
                </article>
            @empty
                <div class="empty">No sessions found.</div>
            @endforelse
        </div>
        <div class="pagination">{{ $sessions->links() }}</div>
    </div>
</section>
@endsection
