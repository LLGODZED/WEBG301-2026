@extends('layouts.app')

@section('title', 'Admin Dashboard - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        @include('admin.partials.nav')
        <h1>Admin Dashboard</h1>
        <div class="grid grid-3">
            <div class="stat"><strong>{{ $sessionCount }}</strong><span>Sessions</span></div>
            <div class="stat"><strong>{{ $registrationCount }}</strong><span>Registrations</span></div>
            <div class="stat"><strong>{{ $userCount }}</strong><span>Users</span></div>
            <div class="stat"><strong>{{ $roomCount }}</strong><span>Rooms</span></div>
            <div class="stat"><strong>{{ $speakerCount }}</strong><span>Speakers</span></div>
            <div class="stat"><strong>{{ $trackCount }}</strong><span>Tracks</span></div>
        </div>
    </div>
</section>
@endsection
