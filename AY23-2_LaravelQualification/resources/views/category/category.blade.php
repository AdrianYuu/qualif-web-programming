@extends('layouts.main')

@section('title', 'Category List')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

<a href="{{ route('category_create') }}" class="btn btn-primary mb-4">Create Category</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th class="col-9">Category Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="col-9">{{ $category->name }}</td>
                <td class="text-center">
                    <a href="{{ route('category_edit', ['category_id' => $category->category_id]) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection