@extends('layouts.app')

@section('title', 'Login - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <div class="card" style="max-width: 520px; margin: 0 auto;">
            <h1>Login</h1>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="remember" value="1" style="width:auto;"> Remember me</label>
                </div>
                <button class="btn" type="submit">Login</button>
            </form>
            <p>Demo admin: <strong>admin@example.com</strong> / <strong>password</strong></p>
        </div>
    </div>
</section>
@endsection
