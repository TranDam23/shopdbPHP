@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Sửa người dùng</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="card shadow-sm" style="max-width:600px">
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Vai trò <span class="text-danger">*</span></label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror">
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Để trống nếu không đổi">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <hr>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">✅ Cập nhật</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection