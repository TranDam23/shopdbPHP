@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Chi tiết sản phẩm</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">✏️ Sửa</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>
    </div>

    <div class="row">
        {{-- Cột hình ảnh --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top rounded"
                         style="max-height:350px; object-fit:cover">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded"
                         style="height:350px">
                        <span class="text-muted fs-1">📦</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Cột thông tin --}}
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        @if($product->is_active)
                            <span class="badge bg-success">Đang bán</span>
                        @else
                            <span class="badge bg-secondary">Ngừng bán</span>
                        @endif
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold text-muted" style="width:150px">Danh mục</td>
                            <td>
                                <span class="badge bg-primary">{{ $product->category->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Giá bán</td>
                            <td class="text-danger fw-bold fs-5">
                                {{ number_format($product->price) }} VND
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Tồn kho</td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="text-success fw-bold">{{ $product->stock }} sản phẩm</span>
                                @elseif($product->stock > 0)
                                    <span class="text-warning fw-bold">{{ $product->stock }} sản phẩm (sắp hết)</span>
                                @else
                                    <span class="text-danger fw-bold">Hết hàng</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Ngày thêm</td>
                            <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Cập nhật</td>
                            <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div>
                        <p class="fw-bold text-muted mb-1">Mô tả sản phẩm</p>
                        <p class="text-dark">
                            {{ $product->description ?? 'Chưa có mô tả.' }}
                        </p>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                            ✏️ Chỉnh sửa
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">🗑️ Xóa sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection