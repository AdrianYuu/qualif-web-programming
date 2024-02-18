@extends('layouts.main')

@section('title', 'Profile Edit')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('profile_update', ['user_id' => $user->user_id]) }}" method="POST" class="w-100">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" value="{{ $user->address }}">
    </div>
    <button type="submit" class="btn btn-warning">Edit</button>
    <a href="{{ route('profile', ['user_id' => $user->user_id]) }}" class="btn btn-secondary">Back</a>
</form>

@if($errors->any())
    <p class="text-danger fw-bold mt-3">
        ERROR: {{$errors->first()}}
    </p>
@endif

@endsection