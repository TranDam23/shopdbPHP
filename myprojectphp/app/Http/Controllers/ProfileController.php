<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class ProfileController extends Controller
{
    // Trang thông tin tài khoản
    public function index()
    {
        $user = auth()->user();
        $totalOrders    = $user->orders()->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();
        $totalSpent     = $user->orders()->where('status', 'completed')->sum('total_amount');

        return view('profile.index', compact('user', 'totalOrders', 'completedOrders', 'totalSpent'));
    }

    // Cập nhật thông tin
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // Đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.index')->with('success', 'Đổi mật khẩu thành công!');
    }

    // Lịch sử mua hàng
    public function orders()
    {
        $orders = auth()->user()->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('profile.orders', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function orderDetail(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');
        return view('profile.order-detail', compact('order'));
    }
}