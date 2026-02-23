@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Chi tiết đơn hàng #{{ $order->order_code }}</h4>
        <a href="{{ route('profile.orders') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-header fw-bold">🛍️ Sản phẩm đã đặt</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">SL</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price) }}</td>
                                <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-end fw-bold text-danger fs-5">
                                    {{ number_format($order->total_amount) }} VND
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">📋 Thông tin đơn hàng</div>
                <div class="card-body">
                    <p><span class="text-muted">Mã đơn:</span> <strong>#{{ $order->order_code }}</strong></p>
                    <p><span class="text-muted">Ngày đặt:</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><span class="text-muted">Địa chỉ:</span> {{ $order->address ?? 'Chưa có' }}</p>
                    <p><span class="text-muted">SĐT:</span> {{ $order->phone ?? 'Chưa có' }}</p>
                    <p>
                        <span class="text-muted">Trạng thái:</span>
                        <span class="badge bg-{{ $order->statusLabel['color'] }}">
                            {{ $order->statusLabel['label'] }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection