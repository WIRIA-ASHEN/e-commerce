@extends('layouts.customer')

@section('title', 'Beranda')

@section('content')
    <h1>Semua Produk</h1>

    <div class="products">
        @foreach ($products as $product)
            @if ($product->is_active === 'active')
                <div class="product">
                    <img src="{{ asset('storage/' . str_replace('public/', '', $product->gambar)) }}"
                        style="width: 200px; height: 200px;">
                    <h2 class="mt-4">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p>Price: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p>Stock: {{ $product->stock }}</p>
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit">Tambah keranjang</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary mt-3" disabled>Stok Habis</button>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endsection
