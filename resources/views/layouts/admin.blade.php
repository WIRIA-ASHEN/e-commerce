<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="flex">
        <aside class="w-64 bg-gray-800 h-screen text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Admin</h2>
            </div>
            <nav class="mt-8">
                <ul>
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <a href="{{ route('admin.produk.index') }}">Manage Products</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-link text-white p-0">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 bg-gray-100 h-screen p-6">
            <header class="mb-4">
                <h1 class="text-3xl font-semibold">@yield('title')</h1>
            </header>
            <hr>
            <div class="content mt-4">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @yield('scripts')
</body>

</html>
