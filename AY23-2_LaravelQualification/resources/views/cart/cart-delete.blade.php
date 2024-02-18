@extends('layouts.main')

@section('title', 'Cart Delete')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<div class="d-flex gap-5">
    <form action="{{ route('cart_destroy', ['item_id' => $item->item_id]) }}" method="POST" class="w-100" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{ $item->name }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" value="{{ $item->category->name }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" value="{{ $item->price }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" value="{{ $item->description }}" disabled="disabled">
        </div>
        <p class="fw-bold">Are you sure want to remove this item from your cart?</p>
        <button type="submit" class="btn btn-danger">Remove</button>
        <a href="{{ route('item_detail', ['item_id' => $item->item_id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
    <div class="d-flex flex-column">
        <label class="form-label">Image</label>
        <img src="{{ Storage::url($item->image_url) }}" alt="image" width="295" height="295">
    </div>
</div>

@endsection