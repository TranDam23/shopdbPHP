@extends('layouts.app')

@section('content')
<div class="row">
    {{-- Sidebar --}}
    <div class="col-md-3">
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;font-size:2rem">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                <small class="text-muted">{{ $user->role === 'admin' ? '👑 Admin' : '👤 User' }}</small>
            </div>
        </div>
        <div class="list-group shadow-sm">
            <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action active">
                👤 Thông tin tài khoản
            </a>
            <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action">
                📦 Lịch sử mua hàng
            </a>
        </div>
    </div>

    {{-- Nội dung chính --}}
    <div class="col-md-9">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Thống kê --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center border-primary">
                    <div class="card-body">
                        <h3 class="text-primary fw-bold">{{ $totalOrders }}</h3>
                        <p class="text-muted mb-0">Tổng đơn hàng</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <h3 class="text-success fw-bold">{{ $completedOrders }}</h3>
                        <p class="text-muted mb-0">Đơn hoàn thành</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-warning">
                    <div class="card-body">
                        <h3 class="text-warning fw-bold">{{ number_format($totalSpent) }}</h3>
                        <p class="text-muted mb-0">Tổng chi tiêu (VND)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form cập nhật thông tin --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">📝 Cập nhật thông tin</div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ tên</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại">
                    </div>
                    <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
                </form>
            </div>
        </div>

        {{-- Form đổi mật khẩu --}}
        <div class="card shadow-sm">
            <div class="card-header fw-bold">🔐 Đổi mật khẩu</div>
            <div class="card-body">
                <form action="{{ route('profile.change-password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mật khẩu mới</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-warning">🔐 Đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection