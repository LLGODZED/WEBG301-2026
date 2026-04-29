@extends('layouts.app')

@section('title', $session->title . ' - Conference Timetable')

@section('content')
<section class="section">
    <div class="container grid grid-2">
        <div class="card">
            <span class="badge">{{ $session->track->name ?? 'General' }}</span>
            <h1>{{ $session->title }}</h1>
            <p>{{ $session->description }}</p>
            <p><strong>Date:</strong> {{ $session->date_label }}</p>
            <p><strong>Time:</strong> {{ $session->time_label }}</p>
            <p><strong>Level:</strong> {{ $session->level }}</p>
            <p><strong>Status:</strong> {{ ucfirst($session->status) }}</p>
        </div>
        <div class="card">
            <h2>Details</h2>
            <p><strong>Room:</strong> {{ $session->room->name ?? '-' }} / {{ $session->room->building ?? '-' }}</p>
            <p><strong>Speaker:</strong> {{ $session->speaker->name ?? '-' }}</p>
            <p><strong>Capacity:</strong> {{ $session->registered_count }}/{{ $session->max_attendees }}</p>
            @auth
                @if($isRegistered)
                    <form method="POST" action="{{ route('registrations.destroy', $session) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Cancel registration</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('registrations.store', $session) }}">
                        @csrf
                        <button class="btn" type="submit">Register for this session</button>
                    </form>
                @endif
            @else
                <p><a class="btn" href="{{ route('login') }}">Login to register</a></p>
            @endauth
        </div>
    </div>
</section>
@endsection
