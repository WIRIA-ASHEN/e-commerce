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
        $order = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$order || !session('snapToken')) {
            // if ($order) {
            //     $order->delete();
            // }

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

        $cart = session()->get('cart', []);

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
                "image" => str_replace('public/', '', $product->gambar),
            ];
        }

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

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong!');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => array_sum(array_column($cart, 'total')),
            'status' => 'pending'
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        $snapToken = $order->getSnapToken();

        return redirect()->route('orders')->with([
            'success' => 'Order berhasil dibuat!',
            'snapToken' => $snapToken
        ]);
    }

    public function paymentSuccess()
    {
        $order = Order::where('user_id', auth()->id())->latest()->first();

        if ($order) {
            $order->update(['status' => 'paid']);

            foreach ($order->orderItems as $item) {
                $product = $item->product;
                $product->decrement('stock', $item->quantity); 
            }

            return redirect()->route('customer.dashboard')->with('success', 'Pembayaran berhasil!');
        }

        return redirect()->route('customer.dashboard')->with('error', 'Order not found!');
    }



}
