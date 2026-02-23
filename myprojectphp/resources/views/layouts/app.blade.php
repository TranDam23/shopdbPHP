<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Điện Tử</title>
    <link href="{{ asset('build/assets/app-CpEEPCb_.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">🛒 Shop Điện Tử</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            @auth
                {{-- Menu Admin --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.index') }}" class="text-white text-decoration-none">Sản phẩm</a>
                    <a href="{{ route('categories.index') }}" class="text-white text-decoration-none">Danh mục</a>
                    <a href="{{ route('users.index') }}" class="text-white text-decoration-none">Người dùng</a>
                @else
                    {{-- Menu Customer --}}
                    <a href="{{ route('shop.index') }}" class="text-white text-decoration-none">Cửa hàng</a>
                    <a href="{{ route('cart.index') }}" class="text-white text-decoration-none position-relative">
                        🛒 Giỏ hàng
                        @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('profile.orders') }}" class="text-white text-decoration-none">Đơn hàng</a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.index') }}" class="text-white text-decoration-none">Sản phẩm</a>
                    <a href="{{ route('categories.index') }}" class="text-white text-decoration-none">Danh mục</a>
                    <a href="{{ route('users.index') }}" class="text-white text-decoration-none">Người dùng</a>
                    <a href="{{ route('admin.orders.index') }}" class="text-white text-decoration-none">📦 Đơn hàng</a>
                @endif

                <span class="text-white">|</span>
                <a href="{{ route('profile.index') }}" class="text-white text-decoration-none">
                    👤 {{ Auth::user()->name }}
                </a>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm">Đăng ký</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</main>

<script src="{{ asset('build/assets/app-CRDNuMHx.js') }}"></script>
</body>
</html>