@extends('layouts.main')

@section('title', 'Item Create')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('item_store') }}" method="POST" class="w-100" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" class="form-control">
            <option value="">Select One</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
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