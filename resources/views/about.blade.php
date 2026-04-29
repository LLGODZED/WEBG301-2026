@extends('layouts.app')

@section('title', 'About - Conference Timetable')

@section('content')
<section class="section">
    <div class="container grid grid-2">
        <div class="card">
            <h1>About the project</h1>
            <p>This project is a conference scheduler adapted for study timetable planning. Admins manage rooms, speakers, tracks and sessions. Students can browse the schedule and register for sessions.</p>
            <p>The system prevents common timetable problems such as assigning one room or one speaker to overlapping sessions.</p>
        </div>
        <div class="card">
            <h2>Core modules</h2>
            <ul>
                <li>Authentication and user roles</li>
                <li>CRUD management</li>
                <li>Schedule and timetable pages</li>
                <li>Registration and conflict detection</li>
                <li>API consumed with JavaScript</li>
            </ul>
        </div>
    </div>
</section>
@endsection
