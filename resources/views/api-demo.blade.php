@extends('layouts.app')

@section('title', 'API Demo - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <div class="card">
            <h1>API consumed with JavaScript</h1>
            <p>This page calls <code>/api/sessions</code> using <code>fetch()</code> and renders the schedule dynamically.</p>
            <div class="api-toolbar">
                <input type="search" placeholder="Search API results..." data-api-search>
                <button class="btn" type="button" data-refresh-sessions>Refresh</button>
            </div>
        </div>
        <div class="grid grid-2" data-api-sessions></div>
    </div>
</section>
@endsection
