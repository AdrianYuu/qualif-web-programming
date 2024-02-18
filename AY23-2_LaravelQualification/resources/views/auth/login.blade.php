@extends('layouts.main')

@section('title', 'Login Page')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 w-100">
    <div class="d-flex flex-column justify-content-center align-items-center p-5 bg-success rounded text-white gap-3">
        <h3 class="fw-bold">Login Page</h3>
        <form action="{{ route('login_process') }}" method="POST" class="d-flex flex-column gap-4">
            @csrf
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column gap-2">
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
            </div>
            @if($errors->any())
                <p class="text-danger fw-bold">
                    ERROR: {{$errors->first()}}
                </p>
            @endif
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-white">Already have an account? <a href="{{ route('register') }}" class="text-white fw-bold" style="text-decoration: none;">Register</a></p>
    </div>
</div>

@endsection