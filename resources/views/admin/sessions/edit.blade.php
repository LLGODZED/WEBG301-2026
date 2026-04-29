@extends('layouts.app')
@section('title', 'Edit Session')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Edit session</h1><form method="POST" action="{{ route('admin.sessions.update', $session) }}">@method('PUT') @include('admin.sessions._form')</form></div></div></section>
@endsection
