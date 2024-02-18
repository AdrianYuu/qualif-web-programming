@extends('layouts.main')

@section('title', 'My Cart')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<h2 class="my-3 fw-bold">My Cart</h2>

@if(count($user->item) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th class="col-2">Name</th>
                <th class="col-2">Category</th>
                <th class="col-4">Description</th>
                <th class="col-2">Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->item as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>Rp {{ $item->price }}</td>
                    <td><img src="{{ Storage::url($item->image_url) }}" alt="image" width="150" height="150"></td>
                    <td>
                        <a href="{{ route('cart_delete', ['item_id' => $item->item_id]) }}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="d-flex align-items-center flex-column w-100">
        <h1 class="fw-bold">Cart is Empty</h1>
    </div>
@endif

@if(count($user->item) > 0)
    <a href="{{ route('invoice_create', ['user_id' => $user->user_id]) }}" class="btn btn-primary mb-4">Checkout</a>
@endif

@endsection