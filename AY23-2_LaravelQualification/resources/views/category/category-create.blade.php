@extends('layouts.main')

@section('title', 'Category Create')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('category_store') }}" method="POST" class="w-100">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('category') }}" class="btn btn-secondary">Back</a>
</form>

@if($errors->any())
    <p class="text-danger fw-bold mt-3">
        ERROR: {{$errors->first()}}
    </p>
@endif

@endsection