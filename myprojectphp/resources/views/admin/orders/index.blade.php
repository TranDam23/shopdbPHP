@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">📦 Quản lý đơn hàng</h2>

    {{-- Lọc theo trạng thái --}}
    <div class="d-flex gap-2 mb-4">
        @foreach(['' => 'Tất cả', 'pending' => 'Chờ xác nhận', 'processing' => 'Đang xử lý',
                  'completed' => 'Hoàn thành', 'cancelled' => 'Đã hủy'] as $val => $label)
        <a href="{{ route('admin.orders.index', ['status' => $val]) }}"
           class="btn btn-sm {{ request('status') == $val ? 'btn-primary' : 'btn-outline-secondary' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th class="text-end">Tổng tiền</th>
                        <th class="text-center">Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->order_code }}</strong></td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td class="text-end text-danger fw-bold">
                            {{ number_format($order->total_amount) }} VND
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $order->statusLabel['color'] }}">
                                {{ $order->statusLabel['label'] }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-info btn-sm text-white">👁 Xem</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không có đơn hàng nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
@endsection