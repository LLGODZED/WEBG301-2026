@extends('layouts.app')
@section('title', 'Room Details')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>{{ $room->name }}</h1><p><strong>Building:</strong> {{ $room->building }}</p><p><strong>Capacity:</strong> {{ $room->capacity }}</p><p>{{ $room->description }}</p></div><div class="card"><h2>Sessions in this room</h2>@foreach($room->sessions as $session)<p><a href="{{ route('admin.sessions.show', $session) }}">{{ $session->title }}</a> · {{ $session->date_label }} {{ $session->time_label }}</p>@endforeach</div></div></section>
@endsection
