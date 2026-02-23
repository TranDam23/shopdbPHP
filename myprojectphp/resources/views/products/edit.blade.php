@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Sửa sản phẩm</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá (VND) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $product->price) }}" min="0">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tồn kho <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $product->stock) }}" min="0">
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($product->image) }}" id="preview"
                                         class="img-fluid rounded" style="max-height:200px">
                                </div>
                            @else
                                <img id="preview" src="#" class="img-fluid rounded d-none mb-2" style="max-height:200px">
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Để trống nếu không muốn đổi ảnh</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                       value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label">Hiển thị sản phẩm</label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">✅ Cập nhật</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection