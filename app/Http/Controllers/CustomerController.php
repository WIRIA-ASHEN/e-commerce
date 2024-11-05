<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    public function index()
    {
        $products = Product::all();
        return view('customer.dashboard', compact('products'));
    }

    public function orders()
    {
        // Retrieve the most recent order for the authenticated user
        $order = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        // Check if the session token exists
        if (!$order || !session('snapToken')) {
            // If there's no order or the session token is missing, delete the order if it exists
            // if ($order) {
            //     $order->delete();
            // }

            // Redirect to the orders page with a message
            return redirect()->route('orders')->with('message', 'Order has been removed due to missing payment token.');
        }

        return view('customer.orders', compact('order'));
    }



    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Get the current cart session or create a new one
        $cart = session()->get('cart', []);

        // If product already exists in cart, increase quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['total'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        } else {
            // Otherwise, add new product to the cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "total" => $product->price,
            ];
        }

        // Update the session cart
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    // Remove product from cart session
    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart successfully!');
    }

    // Checkout - Save cart items as order and order items
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong!');
        }

        // Membuat order baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => array_sum(array_column($cart, 'total')),
            'status' => 'pending'
        ]);

        // Menambahkan setiap item keranjang ke tabel order_items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Menghapus session keranjang
        session()->forget('cart');

        // Dapatkan Snap Token dari Midtrans
        $snapToken = $order->getSnapToken();

        // Arahkan ke halaman order dan kirim token untuk digunakan di view
        return redirect()->route('orders')->with([
            'success' => 'Order berhasil dibuat!',
            'snapToken' => $snapToken
        ]);
    }

    public function paymentSuccess()
    {
        // Retrieve the most recent order for the authenticated user
        $order = Order::where('user_id', auth()->id())->latest()->first();

        // Check if the order exists
        if ($order) {
            // Update the order status
            $order->update(['status' => 'paid']);

            // Loop through each order item to decrease the stock
            foreach ($order->orderItems as $item) {
                // Find the product by its ID and decrease the stock
                $product = $item->product;
                $product->decrement('stock', $item->quantity); // Adjust stock by the quantity ordered
            }

            return redirect()->route('customer.dashboard')->with('success', 'Pembayaran berhasil!');
        }

        return redirect()->route('customer.dashboard')->with('error', 'Order not found!');
    }



}
