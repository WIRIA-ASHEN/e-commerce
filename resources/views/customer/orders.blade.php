@extends('layouts.customer')

@section('title', 'Orders')

@section('content')
    <div class="container">
        <h1>Your Orders</h1>

        @if ($orders->isEmpty())
            <p>You have no orders.</p>
        @else
            @foreach ($orders as $order)
                <div class="card my-4">
                    <div class="card-header">
                        <h5>Order #{{ $order->id }} - {{ $order->created_at->format('d M Y') }}</h5>
                        <p>Status: {{ ucfirst($order->status) }}</p>
                        <p>Total: Rp {{ number_format($order->total, 2, ',', '.') }}</p>
                    </div>
                    <div class="card-body">
                        <h6>Order Items:</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->quantity * $item->price, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection