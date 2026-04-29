@extends('layouts.app')
@section('title', 'Edit Track')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Edit track</h1><form method="POST" action="{{ route('admin.tracks.update', $track) }}">@method('PUT') @include('admin.tracks._form')</form></div></div></section>
@endsection
