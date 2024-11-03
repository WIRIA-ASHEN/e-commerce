@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <form action="{{ route('admin.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Product Image</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Current Image" class="img-thumbnail mt-2" style="width: 150px;">
                <p>Current image</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Status</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="active" {{ $product->is_active == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->is_active == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
