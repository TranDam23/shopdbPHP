@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">🛒 Giỏ hàng của bạn</h2>

    @if($carts->isEmpty())
        <div class="text-center py-5">
            <p class="fs-1">🛒</p>
            <p class="text-muted fs-5">Giỏ hàng đang trống</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Mua sắm ngay</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($cart->product->image)
                                                <img src="{{ Storage::url($cart->product->image) }}"
                                                     style="width:60px;height:60px;object-fit:cover" class="rounded">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                     style="width:60px;height:60px;font-size:1.5rem">📦</div>
                                            @endif
                                            <div>
                                                <p class="fw-bold mb-0">{{ $cart->product->name }}</p>
                                                <small class="text-muted">{{ number_format($cart->product->price) }} VND</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.update', $cart) }}" method="POST"
                                              class="d-flex align-items-center justify-content-center gap-1">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                                   min="1" max="{{ $cart->product->stock }}"
                                                   class="form-control form-control-sm text-center"
                                                   style="width:65px"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold text-danger">
                                        {{ number_format($cart->product->price * $cart->quantity) }} VND
                                    </td>
                                    <td class="text-end">
                                        <form action="{{ route('cart.remove', $cart) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">← Tiếp tục mua</a>
                    <form action="{{ route('cart.clear') }}" method="POST"
                          onsubmit="return confirm('Xóa toàn bộ giỏ hàng?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger">🗑️ Xóa tất cả</button>
                    </form>
                </div>
            </div>

            {{-- Tổng tiền --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold">💰 Tổng đơn hàng</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($total) }} VND</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Tổng cộng:</span>
                            <span class="text-danger">{{ number_format($total) }} VND</span>
                        </div>
                        <a href="{{ route('order.checkout') }}" class="btn btn-primary w-100 mt-3 btn-lg">
                            Đặt hàng →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection