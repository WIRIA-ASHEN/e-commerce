<?php

namespace App\Http\Controllers;

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
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->get();

        return view('customer.orders', compact('orders'));
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
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => array_sum(array_column($cart, 'total')),
            'status' => 'pending'
        ]);

        // Add each cart item to the order items table
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('orders')->with('success', 'Order placed successfully!');
    }
}
