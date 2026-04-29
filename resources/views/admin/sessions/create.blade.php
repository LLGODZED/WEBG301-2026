@extends('layouts.app')
@section('title', 'Create Session')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Create session</h1><p>The system validates room and speaker conflicts before saving.</p><form method="POST" action="{{ route('admin.sessions.store') }}">@include('admin.sessions._form')</form></div></div></section>
@endsection
