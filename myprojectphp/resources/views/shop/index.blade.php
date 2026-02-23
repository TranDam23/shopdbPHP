@extends('layouts.app')

@section('content')
    {{-- Banner --}}
    <div class="bg-primary text-white rounded-3 p-5 mb-4 text-center">
        <h1 class="fw-bold">🛒 Shop Điện Tử</h1>
        <p class="lead mb-0">Sản phẩm chính hãng, giá tốt nhất</p>
    </div>

    {{-- Danh mục nhanh --}}
    <div class="d-flex gap-2 flex-wrap mb-4">
        <a href="{{ route('shop.index') }}"
           class="btn {{ !request('category_id') ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
            Tất cả
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('shop.index', ['category_id' => $cat->id]) }}"
           class="btn {{ request('category_id') == $cat->id ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
            {{ $cat->name }} ({{ $cat->products_count }})
        </a>
        @endforeach
    </div>

    {{-- Tìm kiếm --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('shop.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                               placeholder="🔍 Tìm sản phẩm..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="min_price" class="form-control"
                               placeholder="Giá từ" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="max_price" class="form-control"
                               placeholder="Giá đến" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">Xóa lọc</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    @if($products->isEmpty())
        <div class="text-center py-5">
            <p class="fs-1">🔍</p>
            <p class="text-muted">Không tìm thấy sản phẩm nào</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('shop.show', $product) }}">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                                 style="height:180px;object-fit:cover">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height:180px;font-size:3rem">📦</div>
                        @endif
                    </a>
                    <div class="card-body">
                        <span class="badge bg-secondary mb-1">{{ $product->category->name }}</span>
                        <h6 class="card-title fw-bold">
                            <a href="{{ route('shop.show', $product) }}" class="text-dark text-decoration-none">
                                {{ $product->name }}
                            </a>
                        </h6>
                        <p class="text-danger fw-bold fs-5 mb-1">{{ number_format($product->price) }} VND</p>
                        <p class="small text-muted mb-0">
                            {{ $product->stock > 0 ? 'Còn ' . $product->stock . ' sp' : 'Hết hàng' }}
                        </p>
                    </div>
                    <div class="card-footer">
                        @auth
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button class="btn btn-primary w-100 btn-sm">🛒 Thêm vào giỏ</button>
                                </form>
                            @else
                                <button class="btn btn-secondary w-100 btn-sm" disabled>Hết hàng</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 btn-sm">
                                Đăng nhập để mua
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    @endif
@endsection