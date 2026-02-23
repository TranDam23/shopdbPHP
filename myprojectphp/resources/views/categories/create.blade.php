@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Thêm danh mục</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="card shadow-sm" style="max-width:500px">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Ví dụ: Điện thoại">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">💾 Lưu</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection