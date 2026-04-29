@extends('layouts.app')

@section('title', 'Timetable - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <div class="card">
            <h1>Timetable view</h1>
            <p>Sessions are grouped by date to make the conference / study schedule easier to read.</p>
        </div>
        <div class="section">
            @forelse($sessions as $date => $daySessions)
                <div class="card timetable-day">
                    <h2>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</h2>
                    @foreach($daySessions as $session)
                        <div class="timeline-item">
                            <strong>{{ $session->time_label }} · <a href="{{ route('sessions.show', $session) }}">{{ $session->title }}</a></strong>
                            <p>{{ $session->room->name ?? '-' }} · {{ $session->speaker->name ?? '-' }} · {{ $session->track->name ?? '-' }}</p>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="empty">No timetable data available.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
