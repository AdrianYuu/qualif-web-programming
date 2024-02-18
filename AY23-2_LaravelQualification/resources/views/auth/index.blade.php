@extends('layouts.main')

@section('title', 'Index Page')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 w-100">
    <div class="d-flex flex-column justify-content-center gap-5">
        <img src="{{ asset('/assets/TokopediaLogo.png') }}" alt="logo">
        <div class="d-flex gap-4 flex-column">
            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
            <a class="btn btn-secondary" href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>

@endsection