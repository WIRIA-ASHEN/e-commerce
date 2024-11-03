<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahproduk = Product::count();
        $totalpesanan = Order::count();
        $jumlahuser = User::count();
        return view('admin.dashboard', compact('jumlahproduk', 'totalpesanan', 'jumlahuser'));
    }

    public function produk()
    {
        $products = Product::all();
        return view('admin.produk.index', compact('products'));
    }

    public function create_produk()
    {
        return view('admin.produk.create');
    }

    public function store_produk(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            // 'is_active' => 'nullable|boolean', // 'nullable' allows checkbox unchecked state
        ]);

        // Upload the image
        $path = $request->file('gambar')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'gambar' => $path,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Product created successfully.');
    }

    public function edit_produk(Product $product)
    {

        return view('admin.produk.edit', compact('product'));
    }

    public function update_produk(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            // 'is_active' => 'required|boolean',
        ]);

        // Upload new image if provided
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images', 'public');
            $product->gambar = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Product updated successfully.');
    }

    public function delete_produk(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        // Toggle the status
        $product->is_active = $product->is_active === 'active' ? 'inactive' : 'active';
        $product->save();

        // Return the new status as JSON
        return response()->json(['is_active' => $product->is_active]);
    }

}
