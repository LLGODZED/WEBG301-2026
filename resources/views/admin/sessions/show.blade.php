@extends('layouts.app')
@section('title', 'Session Details')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="grid grid-2"><div class="card"><h1>{{ $session->title }}</h1><p>{{ $session->description }}</p><p><strong>Time:</strong> {{ $session->date_label }} {{ $session->time_label }}</p><p><strong>Room:</strong> {{ $session->room->name ?? '-' }}</p><p><strong>Speaker:</strong> {{ $session->speaker->name ?? '-' }}</p><p><strong>Track:</strong> {{ $session->track->name ?? '-' }}</p><p><strong>Status:</strong> {{ $session->status }}</p></div><div class="card"><h2>Registered students</h2>@forelse($session->registrations as $registration)<p>{{ $registration->user->name }} · {{ $registration->user->email }} · {{ $registration->status }}</p>@empty<p class="empty">No registrations yet.</p>@endforelse</div></div></div></section>
@endsection
