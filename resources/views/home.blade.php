@extends('layouts.app')

@section('title', 'Home - Conference Timetable')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="badge">Conference Scheduler / Study Timetable</span>
            <h1>Plan sessions, rooms, speakers and student schedules without conflicts.</h1>
            <p>This application manages a conference-style academic timetable with tracks, rooms, speakers, registrations, role-based access and API integration.</p>
            <div class="actions">
                <a class="btn" href="{{ route('sessions.index') }}">View Schedule</a>
                <a class="btn btn-secondary" href="{{ route('sessions.timetable') }}">Open Timetable</a>
            </div>
        </div>
        <div class="card">
            <h2>Project highlights</h2>
            <ul>
                <li>CRUD management for the admin.</li>
                <li>Login/register and protected dashboard.</li>
                <li>Conflict checks for rooms, speakers and students.</li>
                <li>JSON API consumed by JavaScript.</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-4">
            <div class="stat"><strong>{{ $sessionCount }}</strong><span>Sessions</span></div>
            <div class="stat"><strong>{{ $roomCount }}</strong><span>Rooms</span></div>
            <div class="stat"><strong>{{ $speakerCount }}</strong><span>Speakers</span></div>
            <div class="stat"><strong>{{ $trackCount }}</strong><span>Tracks</span></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Upcoming sessions</h2>
        <div class="grid grid-2">
            @forelse($upcomingSessions as $session)
                <article class="card">
                    <span class="badge" style="background: {{ $session->track->color ?? '#eaf1ff' }}20; color: {{ $session->track->color ?? '#1d4ed8' }}">{{ $session->track->name ?? 'General' }}</span>
                    <h3><a href="{{ route('sessions.show', $session) }}">{{ $session->title }}</a></h3>
                    <p>{{ Str::limit($session->description, 120) }}</p>
                    <p><strong>{{ $session->date_label }}</strong> · {{ $session->time_label }}</p>
                    <p>{{ $session->room->name ?? '-' }} · {{ $session->speaker->name ?? '-' }}</p>
                </article>
            @empty
                <div class="empty">No sessions yet.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
