@extends('layouts.main')

@section('title', 'Category Edit')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('category_update', ['category_id' => $category->category_id]) }}" method="POST" class="w-100">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
    </div>
    <button type="submit" class="btn btn-warning">Edit</button>
    <a href="{{ route('category') }}" class="btn btn-secondary">Back</a>
</form>

@if($errors->any())
    <p class="text-danger fw-bold mt-3">
        ERROR: {{$errors->first()}}
    </p>
@endif

@endsection