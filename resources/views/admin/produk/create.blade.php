@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Product Image</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
        </div>

        <input type="hidden" name="is_active" id="is_active" value="active"> 

        <button type="submit" class="btn btn-success">Save Product</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
