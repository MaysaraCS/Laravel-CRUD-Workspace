@extends('layouts.auth')

@section('style')
<style>
    html, body {
        height: 100%;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="text"],
    .form-signin input[type="email"],
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-radius: 0;
    }

    .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
@endsection

@section('content')
<main class="form-signin w-100 m-auto">
    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        {{-- Logo --}}
        <img class="mb-4" src="{{ asset('assets/img/login.png') }}" alt="Logo" width="72" height="57">

        <h1 class="h3 mb-3 fw-normal">Sign in Form</h1>

        {{-- Username --}}
        <div class="form-floating">
            <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required autofocus>
            <label for="floatingUsername">Username</label>
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" name="remember" id="checkDefault">
            <label class="form-check-label" for="checkDefault">Remember me</label>
        </div>

        {{-- Session messages --}}
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif

        {{-- Submit --}}
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2025</p>
    </form>
</main>
@endsection
