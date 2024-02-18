@extends('layouts.main')

@section('title', 'Item Edit')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('item_update', ['item_id' => $item->item_id]) }}" method="POST" class="w-100" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $item->name }}">
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" class="form-control">
            <option value="{{ $item->category->category_id }}">{{ $item->category->name }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" value="{{ $item->price }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="{{ $item->description }}">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <button type="submit" class="btn btn-warning">Edit</button>
    <a href="{{ route('item_detail', ['item_id' => $item->item_id]) }}" class="btn btn-secondary">Back</a>
</form>

@if($errors->any())
    <p class="text-danger fw-bold mt-3">
        ERROR: {{$errors->first()}}
    </p>
@endif

@endsection