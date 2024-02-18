@extends('layouts.main')

@section('title', 'Home Page')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<form action="{{ route('item_search') }}" method="GET" class="d-flex gap-2">
    @csrf
    <input type="text" class="form-control w-60" placeholder="Search..." name="search">
    <button type="submit" class="btn btn-outline-success">Search</button>
</form>

<div class="row row-cols-1 row-cols-md-4 g-4 mb-5 mt-2">
    @forelse($items as $item)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ Storage::url($item->image_url) }}" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title fw-bold fs-4">{{ $item->name }}</h5>
                    <p class="card-text fs-6">{{ $item->category->name }}</p>
                    <p class="card-text fs-5">Rp {{ $item->price }}</p>
                    <a href="{{ route('item_detail', ['item_id' => $item->item_id]) }}" class="btn btn-outline-success">More Detail</a>
                </div>
            </div>
        </div>
    @empty
        <div class="d-flex align-items-center flex-column w-100">
            <h1 class="fw-bold">No Item Available</h1>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mb-4">
    {{ $items->links('pagination::bootstrap-4') }}
</div>

@endsection