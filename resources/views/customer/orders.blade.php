@extends('layouts.customer')

@section('title', 'Orders')

@section('content')
    <div class="container">
        <h1>Your Orders</h1>

        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        @if (!$order) <!-- Check if there is an order -->
            <p>You have no orders.</p>
        @else
            <div class="card my-4">
                <div class="card-header">
                    <h5>Order #{{ $order->id }} - {{ $order->created_at->format('d M Y') }}</h5>
                    <p>Status: {{ ucfirst($order->status) }}</p>
                    <p>Total: Rp {{ number_format($order->total, 2, ',', '.') }}</p>
                    @if ($order->status == 'pending')
                        <button class="btn btn-primary mt-3 pay-button" data-snap-token="{{ session('snapToken') }}">Bayar
                            Sekarang</button>
                    @endif
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
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script type="text/javascript">
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function() {
                let snapToken = this.getAttribute('data-snap-token');
                if (!snapToken) {
                    alert('Token not available. Please refresh and try again.');
                    return;
                }
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('payment.success') }}";
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran.");
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                    }
                });
            });
        });
    </script>
@endsection
