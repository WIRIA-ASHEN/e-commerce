@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@section('content')
    <h1>Keranjang Belanja</h1>

    @if (session('cart') && count(session('cart')) > 0)
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $id => $details)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}"
                                style="width: 100px; height: 100px;">
                        </td>

                        <td>{{ $details['name'] }}</td>
                        <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-4">Total: Rp {{ number_format(array_sum(array_column(session('cart'), 'total')), 0, ',', '.') }}</p>

        <div class="d-flex justify-content-between">
            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
            <a href="{{ route('customer.dashboard') }}" class="btn btn-warning">Tambah Keranjang</a>
        </div>
    @else
        <p>Keranjang anda kosong</p>
    @endif
@endsection
