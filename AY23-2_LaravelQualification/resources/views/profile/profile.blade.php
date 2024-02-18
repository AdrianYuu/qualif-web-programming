@extends('layouts.main')

@section('title', 'My Profile')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<div class="d-flex justify-content-center p-4">
    <div class="card mb-3" style="width: 1200px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('assets/Profile.png') }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body d-flex justify-content-center flex-column  h-100">
                    <p class="card-title fw-bold fs-1">{{ $user->name }}</p>
                    <p class="card-text fw-medium fs-4">Email: {{ $user->email }}</p>
                    <p class="card-text fw-medium fs-4">Phone: {{ $user->phone }}</p>
                    <p class="card-text fw-medium fs-4">Address: {{ $user->address }}</p>
                    <p class="card-text fw-medium fs-4">Role: {{ $user->role->name }}</p>
                    <div>
                        <a href="{{ route('profile_edit', ['user_id' => $user->user_id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection