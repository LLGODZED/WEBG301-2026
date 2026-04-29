@extends('layouts.app')

@section('title', 'Register - Conference Timetable')

@section('content')
<section class="section">
    <div class="container">
        <div class="card" style="max-width: 560px; margin: 0 auto;">
            <h1>Create account</h1>
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <button class="btn" type="submit">Register</button>
            </form>
        </div>
    </div>
</section>
@endsection
