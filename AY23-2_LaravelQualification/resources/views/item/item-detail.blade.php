@extends('layouts.main')

@section('title', 'Item Detail')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<div class="d-flex justify-content-center p-4">
    <div class="card mb-3" style="width: 1200px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ Storage::url($item->image_url) }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body d-flex justify-content-center flex-column mx-3">
                    <p class="card-title fw-medium fs-1">{{ $item->name }}</p>
                    <p class="card-text">Category: {{ $item->category->name }}</p>
                    <p class="card-text fw-bold fs-2">Rp {{ $item->price }}</p>
                    <p class="card-text text-success fw-medium fs-5">Description</p>
                    <hr class="border border-success border-1 opacity-75 mt-0">
                    <p class="card-text">{{ $item->description }}</p>
                    <div class="d-flex justify-content-between align-items-end">
                        @if(Auth::user()->role->name == "member")
                            <div class="d-flex gap-1">
                                <form action="{{ route('cart_store', ['item_id' => $item->item_id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                                </form>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                            </div>
                        @endif
                        @if(Auth::user()->role->name == "admin")
                            <div class="d-flex gap-1">
                                <a href="{{ route('item_edit', ['item_id' => $item->item_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('item_delete', ['item_id' => $item->item_id]) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection