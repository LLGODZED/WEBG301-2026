@extends('layouts.app')
@section('title', 'Edit Room')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Edit room</h1><form method="POST" action="{{ route('admin.rooms.update', $room) }}">@method('PUT') @include('admin.rooms._form')</form></div></div></section>
@endsection
