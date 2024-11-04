<!-- resources/views/home.blade.php -->
@extends('layouts.customer')

@section('title', 'Home')

@section('content')
<h1>All Products</h1>

<div class="products">
    @foreach($products as $product)
        @if($product->is_active === 'active' && $product->stock > 0)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p>Price: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stock: {{ $product->stock }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @endif
    @endforeach
</div>
@endsection
