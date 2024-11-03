@extends('layouts.admin')

@section('title', 'Produk')

@section('content')
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Create New Product</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>
                        Status
                        <i class="bi bi-question-circle" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                            title="Product Status"
                            data-bs-content="Klik untuk active atau inactive produk.">
                        </i>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('storage/' . str_replace('public/', '', $product->gambar)) }}" width="100"
                                class="img-thumbnail"></td>
                        <td>{{ $product->description }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <button
                                class="btn btn-sm {{ $product->is_active == 'active' ? 'btn-success' : 'btn-secondary' }} toggle-status"
                                data-id="{{ $product->id }}">
                                {{ $product->is_active == 'active' ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('admin.produk.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.produk.delete', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all toggle buttons
            const toggleButtons = document.querySelectorAll('.toggle-status');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const button = this;

                    // Send AJAX request
                    fetch(`/admin/produk/${productId}/toggle-status`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Update button appearance based on new status
                            if (data.is_active === 'active') {
                                button.classList.remove('btn-secondary');
                                button.classList.add('btn-success');
                                button.textContent = 'Active';
                            } else {
                                button.classList.remove('btn-success');
                                button.classList.add('btn-secondary');
                                button.textContent = 'Inactive';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>


    <script>
        // Initialize Bootstrap Popovers
        document.addEventListener('DOMContentLoaded', function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        });
    </script>


@endsection
