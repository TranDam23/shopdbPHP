@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Cửa hàng</a></li>
            <li class="breadcrumb-item">{{ $product->category->name }}</li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded shadow">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center shadow"
                     style="height:350px;font-size:5rem">📦</div>
            @endif
        </div>
        <div class="col-md-7">
            <span class="badge bg-primary mb-2">{{ $product->category->name }}</span>
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <h3 class="text-danger fw-bold my-3">{{ number_format($product->price) }} VND</h3>

            <div class="mb-3">
                @if($product->stock > 10)
                    <span class="text-success">✅ Còn hàng ({{ $product->stock }} sản phẩm)</span>
                @elseif($product->stock > 0)
                    <span class="text-warning">⚠️ Sắp hết hàng (còn {{ $product->stock }})</span>
                @else
                    <span class="text-danger">❌ Hết hàng</span>
                @endif
            </div>

            <p class="text-muted">{{ $product->description ?? 'Chưa có mô tả.' }}</p>

            @auth
                @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-primary btn-lg px-4">🛒 Thêm vào giỏ hàng</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg">Xem giỏ hàng</a>
                    </form>
                @else
                    <button class="btn btn-secondary btn-lg" disabled>Hết hàng</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Đăng nhập để mua hàng</a>
            @endauth
        </div>
    </div>

    {{-- Sản phẩm liên quan --}}
    @if($related->isNotEmpty())
    <div class="mt-4">
        <h5 class="fw-bold mb-3">Sản phẩm liên quan</h5>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach($related as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('shop.show', $item) }}">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="card-img-top"
                                 style="height:140px;object-fit:cover">
                        @else
                            <div class="bg-light text-center py-4" style="font-size:2rem">📦</div>
                        @endif
                    </a>
                    <div class="card-body p-2">
                        <p class="small fw-bold mb-1">{{ $item->name }}</p>
                        <p class="text-danger small fw-bold mb-0">{{ number_format($item->price) }} VND</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection