@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- <p>Selamat datang di Admin Dashboard!</p> --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Produk</h2>
            <p>Jumlah produk yang tersedia: {{ $jumlahproduk }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Pesanan</h2>
            <p>Jumlah pesanan yang diterima: {{ $totalpesanan }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Pengguna</h2>
            <p>Jumlah pengguna terdaftar: {{ $jumlahuser }}</p>
        </div>
    </div>
@endsection
