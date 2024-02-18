@extends('layouts.main')

@section('title', 'Invoice Create')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

@php
    $total_price = 0
@endphp

<h2 class="fw-bold text-center my-5">INVOICE</h2>

<div class="d-flex gap-5">
    <form action="{{ route('invoice_store', ['user_id' => $user->user_id]) }}" method="POST" class="w-100 mb-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" value="{{ $user->address }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="form-label">Item List</label>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th class="col-2">Name</th>
                        <th class="col-1">Category</th>
                        <th class="col-2">Price</th>
                        <th class="col-5">Description</th>
                        <th class="col-4">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->item as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>Rp {{ $item->price }}</td>
                        <td>Rp {{ $item->description }}</td>
                        <td>
                            <img src="{{ Storage::url($item->image_url) }}" alt="" width="200" height="200">
                        </td>
                    </tr>
                    @php
                        $total_price += $item->price
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <label class="form-label" for="total_price">Total Price</label>
            <input type="text" class="form-control" name="total_price" value="Rp {{ $total_price }}" disabled="disabled">
        </div>
        <div class="mb-3">
            <label class="form-label" for="payment_id">Payment Method</label>
            <select name="payment_id" class="form-control">
                <option value="">Select One...</option>
                @foreach($payments as $payment)
                    <option value="{{ $payment->payment_id }}">{{ $payment->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Checkout</button>
        <a href="{{ route('cart', ['user_id' => $user->user_id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@if($errors->any())
    <p class="text-danger fw-bold">
        ERROR: {{$errors->first()}}
    </p>
@endif

@endsection