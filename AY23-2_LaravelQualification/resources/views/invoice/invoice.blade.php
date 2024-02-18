@extends('layouts.main')

@section('title', 'Invoice List')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

@if(count($invoices) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Payment Method</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->user->name }}</td>
                    <td>{{ $invoice->payment->name }}</td>
                    <td>Rp {{ $invoice->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="d-flex align-items-center flex-column w-100">
        <h1 class="fw-bold">There is No Invoice</h1>
    </div>
@endif

@endsection