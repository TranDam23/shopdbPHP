<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);
        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            if ($cart->quantity < $product->stock) {
                $cart->increment('quantity');
            } else {
                return back()->with('error', 'Không đủ hàng trong kho!');
            }
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);

        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($request->quantity > $cart->product->stock) {
            return back()->with('error', 'Không đủ hàng trong kho!');
        }

        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);
        $cart->delete();
        return back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
}