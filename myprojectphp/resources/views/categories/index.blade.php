@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Quản lý danh mục</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($categories as $category)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex
                                align-items-center justify-content-center mb-3"
                         style="width:70px;height:70px;font-size:1.8rem">
                        {{ ['Điện thoại'=>'📱','Laptop'=>'💻','Máy tính bảng'=>'📲',
                            'Tai nghe'=>'🎧','Đồng hồ thông minh'=>'⌚'][$category->name] ?? '📦' }}
                    </div>
                    <h5 class="fw-bold">{{ $category->name }}</h5>
                    <p class="text-muted">{{ $category->products_count }} sản phẩm</p>
                    <a href="{{ route('categories.show', $category) }}"
                       class="btn btn-outline-primary btn-sm">
                        Xem sản phẩm →
                    </a>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-center gap-2">
                    <a href="{{ route('categories.edit', $category) }}"
                       class="btn btn-warning btn-sm">✏️ Sửa</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Xóa danh mục này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑️ Xóa</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Chưa có danh mục nào</p>
        </div>
        @endforelse
    </div>
@endsection