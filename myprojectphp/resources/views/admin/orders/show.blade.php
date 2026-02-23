@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Đơn hàng #{{ $order->order_code }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            {{-- Danh sách sản phẩm --}}
            <div class="card shadow-sm mb-4">
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
                                <td class="text-end fw-bold">
                                    {{ number_format($item->price * $item->quantity) }}
                                </td>
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
            {{-- Thông tin đơn hàng --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">📋 Thông tin đơn hàng</div>
                <div class="card-body">
                    <p><span class="text-muted">Khách hàng:</span> <strong>{{ $order->user->name }}</strong></p>
                    <p><span class="text-muted">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="text-muted">SĐT:</span> {{ $order->phone }}</p>
                    <p><span class="text-muted">Địa chỉ:</span> {{ $order->address }}</p>
                    <p><span class="text-muted">Ngày đặt:</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p>
                        <span class="text-muted">Trạng thái:</span>
                        <span class="badge bg-{{ $order->statusLabel['color'] }} fs-6">
                            {{ $order->statusLabel['label'] }}
                        </span>
                    </p>
                </div>
            </div>

            {{-- Cập nhật trạng thái --}}
            <div class="card shadow-sm">
                <div class="card-header fw-bold">🔄 Cập nhật trạng thái</div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                @foreach(['pending' => 'Chờ xác nhận', 'processing' => 'Đang xử lý',
                                          'completed' => 'Hoàn thành', 'cancelled' => 'Đã hủy'] as $val => $label)
                                <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">✅ Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection