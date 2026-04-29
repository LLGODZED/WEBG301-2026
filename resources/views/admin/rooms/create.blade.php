@extends('layouts.app')
@section('title', 'Create Room')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Create room</h1><form method="POST" action="{{ route('admin.rooms.store') }}">@include('admin.rooms._form')</form></div></div></section>
@endsection
