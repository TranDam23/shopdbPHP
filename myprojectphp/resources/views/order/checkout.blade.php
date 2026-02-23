@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">📦 Xác nhận đặt hàng</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">📋 Thông tin giao hàng</div>
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ tên</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', auth()->user()->phone) }}" placeholder="Nhập số điện thoại">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea name="address" rows="3"
                                      class="form-control @error('address') is-invalid @enderror"
                                      placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố">{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">🛒 Đơn hàng của bạn</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        @foreach($carts as $cart)
                        <tr>
                            <td>
                                <p class="fw-bold mb-0 small">{{ $cart->product->name }}</p>
                                <small class="text-muted">x{{ $cart->quantity }}</small>
                            </td>
                            <td class="text-end text-danger fw-bold">
                                {{ number_format($cart->product->price * $cart->quantity) }} VND
                            </td>
                        </tr>
                        @endforeach
                        <tr class="table-light">
                            <td class="fw-bold">Tổng cộng</td>
                            <td class="text-end fw-bold text-danger fs-5">{{ number_format($total) }} VND</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" form="checkout-form" class="btn btn-success w-100 btn-lg">
                        ✅ Xác nhận đặt hàng
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        ← Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection