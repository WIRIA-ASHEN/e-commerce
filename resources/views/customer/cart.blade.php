<!-- resources/views/cart.blade.php -->
@extends('layouts.customer')

@section('title', 'Shopping Cart')

@section('content')
<h1>Shopping Cart</h1>

@if(session('cart') && count(session('cart')) > 0)
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>Rp{{ number_format($details['price'], 0, ',', '.') }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total: Rp{{ number_format(array_sum(array_column(session('cart'), 'total')), 0, ',', '.') }}</p>

    <a href="{{ route('checkout') }}" class="btn">Proceed to Checkout</a>
@else
    <p>Your cart is empty.</p>
@endif
@endsection
