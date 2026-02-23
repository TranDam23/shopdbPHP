@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh sách sản phẩm</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tìm kiếm --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Nhập tên sản phẩm..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">Tất cả</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Giá từ (VND)</label>
                        <input type="number" name="min_price" class="form-control"
                               placeholder="0" value="{{ request('min_price') }}" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Giá đến (VND)</label>
                        <input type="number" name="max_price" class="form-control"
                               placeholder="Không giới hạn" value="{{ request('max_price') }}" min="0">
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">🔍 Tìm</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">↺</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Kết quả tìm kiếm --}}
    @if(request()->hasAny(['search','category_id','min_price','max_price']))
        <p class="text-muted mb-3">
            Tìm thấy <strong>{{ $products->total() }}</strong> sản phẩm
            @if(request('search')) cho "<strong>{{ request('search') }}</strong>" @endif
        </p>
    @endif

    @if($products->isEmpty())
        <div class="text-center py-5">
            <p class="fs-1">🔍</p>
            <p class="text-muted">Không tìm thấy sản phẩm nào</p>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Xem tất cả</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                             style="height:180px;object-fit:cover">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                             style="height:180px">No Image</div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted small">{{ $product->category->name }}</p>
                        <p class="text-primary fw-bold">{{ number_format($product->price) }} VND</p>
                        <p class="small">Tồn kho: {{ $product->stock }}</p>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-info btn-sm text-white flex-fill">👁 Xem</a>
                        <a href="{{ route('products.edit', $product) }}"
                           class="btn btn-warning btn-sm flex-fill">Sửa</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Xóa sản phẩm này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    @endif
@endsection