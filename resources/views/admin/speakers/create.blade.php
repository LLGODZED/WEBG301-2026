@extends('layouts.app')
@section('title', 'Create Speaker')
@section('content')
<section class="section"><div class="container">@include('admin.partials.nav')<div class="card"><h1>Create speaker</h1><form method="POST" action="{{ route('admin.speakers.store') }}">@include('admin.speakers._form')</form></div></div></section>
@endsection
