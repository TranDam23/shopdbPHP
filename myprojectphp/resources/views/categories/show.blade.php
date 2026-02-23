@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh mục: {{ $category->name }}</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    <p class="text-muted">Có <strong>{{ $products->total() }}</strong> sản phẩm trong danh mục này</p>

    @if($products->isEmpty())
        <div class="text-center py-5">
            <p class="fs-1">📭</p>
            <p class="text-muted">Danh mục này chưa có sản phẩm nào</p>
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
                        <p class="text-primary fw-bold">{{ number_format($product->price) }} VND</p>
                        <p class="small text-muted">Tồn kho: {{ $product->stock }}</p>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-info btn-sm text-white flex-fill">👁 Xem</a>
                        <a href="{{ route('products.edit', $product) }}"
                           class="btn btn-warning btn-sm flex-fill">Sửa</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    @endif
@endsection