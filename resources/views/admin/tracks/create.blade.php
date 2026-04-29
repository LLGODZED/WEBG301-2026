@extends('layouts.app')
@section('title', 'Create Track')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Create track</h1><form method="POST" action="{{ route('admin.tracks.store') }}">@include('admin.tracks._form')</form></div></div></section>
@endsection
