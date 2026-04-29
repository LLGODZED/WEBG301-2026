@extends('layouts.app')

@section('title', 'Dashboard - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <h1>My Dashboard</h1>
        <div class="grid grid-2">
            <div class="card">
                <h2>My registered sessions</h2>
                @forelse($mySessions as $session)
                    <div class="timeline-item">
                        <strong><a href="{{ route('sessions.show', $session) }}">{{ $session->title }}</a></strong>
                        <p>{{ $session->date_label }} · {{ $session->time_label }}</p>
                        <p>{{ $session->room->name ?? '-' }} · {{ $session->speaker->name ?? '-' }}</p>
                    </div>
                @empty
                    <p class="empty">You have not registered for any sessions yet.</p>
                @endforelse
            </div>
            <div class="card">
                <h2>Suggested upcoming sessions</h2>
                @foreach($suggestedSessions as $session)
                    <p><a href="{{ route('sessions.show', $session) }}">{{ $session->title }}</a><br><span class="badge-muted badge">{{ $session->date_label }} {{ $session->time_label }}</span></p>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
