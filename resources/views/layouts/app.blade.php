<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Conference Timetable')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container navbar-inner">
            <a class="brand" href="{{ route('home') }}">Conference Timetable</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('sessions.index') }}">Schedule</a>
                <a href="{{ route('sessions.timetable') }}">Timetable</a>
                <a href="{{ route('api.demo') }}">API Demo</a>
                <a href="{{ route('about') }}">About</a>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a class="btn btn-small" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            @include('partials.flash')
        </div>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>Conference Timetable Scheduler - Laravel project with Docker, CRUD, authorization, API and JavaScript.</p>
        </div>
    </footer>
    <script src="{{ asset('js/schedule-api.js') }}"></script>
</body>
</html>
