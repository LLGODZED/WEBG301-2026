@extends('layouts.app')
@section('title', 'Speaker Details')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>{{ $speaker->name }}</h1><p><strong>Email:</strong> {{ $speaker->email }}</p><p><strong>Phone:</strong> {{ $speaker->phone }}</p><p>{{ $speaker->bio }}</p></div><div class="card"><h2>Sessions</h2>@foreach($speaker->sessions as $session)<p><a href="{{ route('admin.sessions.show', $session) }}">{{ $session->title }}</a> · {{ $session->date_label }} {{ $session->time_label }}</p>@endforeach</div></div></section>
@endsection
