@extends('layouts.app')
@section('title', 'Track Details')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>{{ $track->name }}</h1><p><span class="badge" style="background:{{ $track->color }}20; color:{{ $track->color }}">{{ $track->color }}</span></p><p>{{ $track->description }}</p></div><div class="card"><h2>Sessions</h2>@foreach($track->sessions as $session)<p><a href="{{ route('admin.sessions.show', $session) }}">{{ $session->title }}</a> · {{ $session->date_label }} {{ $session->time_label }}</p>@endforeach</div></div></section>
@endsection
