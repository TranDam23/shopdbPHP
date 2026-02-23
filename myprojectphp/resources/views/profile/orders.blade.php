@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group shadow-sm">
            <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action">
                👤 Thông tin tài khoản
            </a>
            <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action active">
                📦 Lịch sử mua hàng
            </a>
        </div>
    </div>

    <div class="col-md-9">
        <h4 class="fw-bold mb-4">📦 Lịch sử mua hàng</h4>

        @forelse($orders as $order)
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Đơn hàng #{{ $order->order_code }}</span>
                <span class="badge bg-{{ $order->statusLabel['color'] }}">
                    {{ $order->statusLabel['label'] }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @foreach($order->items as $item)
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-2">📱</span>
                            <span>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</span>
                            <span class="text-muted ms-2">x{{ $item->quantity }}</span>
                            <span class="ms-auto fw-bold">{{ number_format($item->price * $item->quantity) }} VND</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-4 text-end">
                        <p class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p class="fw-bold text-danger">Tổng: {{ number_format($order->total_amount) }} VND</p>
                        <a href="{{ route('profile.order-detail', $order) }}" class="btn btn-outline-primary btn-sm">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <p class="fs-1">📭</p>
            <p class="text-muted">Bạn chưa có đơn hàng nào</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Mua ngay</a>
        </div>
        @endforelse

        <div class="mt-3">{{ $orders->links() }}</div>
    </div>
</div>
@endsection