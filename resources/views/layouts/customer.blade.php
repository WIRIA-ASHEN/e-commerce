<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - E-Commerce</title>
    <!-- Midtrans Snap.js -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('customer.dashboard') }}">Home</a>
            <a href="{{ route('orders') }}">Orders</a>
            <a href="{{ route('cart') }}">Cart ({{ session('cart') ? count(session('cart')) : 0 }})</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} E-Commerce. All rights reserved.</p>
    </footer>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('script')
</body>

</html>
