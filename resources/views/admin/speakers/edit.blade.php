@extends('layouts.app')
@section('title', 'Edit Speaker')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Edit speaker</h1><form method="POST" action="{{ route('admin.speakers.update', $speaker) }}">@method('PUT') @include('admin.speakers._form')</form></div></div></section>
@endsection
