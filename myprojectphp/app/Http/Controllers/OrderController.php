<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }
        $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);
        return view('order.checkout', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'phone'   => 'required|string|max:15',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);

        $order = Order::create([
            'user_id'      => auth()->id(),
            'order_code'   => 'ORD-' . strtoupper(Str::random(8)),
            'total_amount' => $total,
            'status'       => 'pending',
            'address'      => $request->address,
            'phone'        => $request->phone,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->price,
            ]);
            // Trừ tồn kho
            $cart->product->decrement('stock', $cart->quantity);
        }

        // Xóa giỏ hàng sau khi đặt
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('profile.orders')->with('success', 'Đặt hàng thành công! Mã đơn: ' . $order->order_code);
    }
}