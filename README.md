<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# ShopDB PHP

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
Đây là một ứng dụng thương mại điện tử đơn giản được xây dựng bằng Laravel, cho phép người dùng duyệt sản phẩm, thêm vào giỏ hàng, đặt hàng và quản lý hồ sơ cá nhân. Ngoài ra, hệ thống còn hỗ trợ các chức năng quản trị cho admin như quản lý sản phẩm, danh mục, người dùng và đơn hàng.

## About Laravel
## Tính năng chính

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
- Trang shop công khai hiển thị danh sách sản phẩm
- Tìm kiếm và lọc sản phẩm theo danh mục, giá và từ khóa
- Xem chi tiết sản phẩm
- Giỏ hàng và cập nhật số lượng sản phẩm
- Thanh toán và tạo đơn hàng
- Xem lịch sử đơn hàng và chi tiết đơn hàng
- Quản lý hồ sơ cá nhân và đổi mật khẩu
- Quản trị hệ thống:
  - Quản lý danh mục sản phẩm
  - Quản lý sản phẩm
  - Quản lý người dùng
  - Quản lý trạng thái đơn hàng

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
## Công nghệ sử dụng

Laravel is accessible, powerful, and provides tools required for large, robust applications.
- PHP 8.2
- Laravel 12
- Bootstrap 5
- Vite
- SQLite (mặc định trong file cấu hình mẫu)
- Pest cho testing

## Learning Laravel
## Cấu trúc dự án

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.
- app/Http/Controllers: xử lý các request và logic nghiệp vụ
- app/Models: các model như Product, Category, Order, User, Cart
- database/migrations: schema cơ sở dữ liệu
- database/seeders: dữ liệu mẫu cho danh mục và sản phẩm
- resources/views: giao diện Blade
- routes/web.php: định nghĩa route chính

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
## Yêu cầu hệ thống

## Laravel Sponsors
- PHP 8.2+
- Composer
- Node.js và npm

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).
## Hướng dẫn cài đặt

### Premium Partners
1. Clone repository:

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**
```bash
git clone <your-repo-url>
cd myprojectphp
```

## Contributing
2. Cài đặt PHP dependencies:

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).
```bash
composer install
```

## Code of Conduct
3. Tạo file môi trường:

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).
```bash
cp .env.example .env
php artisan key:generate
```

## Security Vulnerabilities
4. Tạo database SQLite (nếu sử dụng cấu hình mặc định):

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
```bash
touch database/database.sqlite
```

5. Chạy migrations và seed dữ liệu:

```bash
php artisan migrate --seed
```

6. Cài đặt frontend dependencies và build assets:

```bash
npm install
npm run build
```

7. Khởi chạy ứng dụng:

```bash
php artisan serve
```

Sau đó mở trình duyệt tại:

```text
http://localhost:8000
```

## Sử dụng

- Người dùng có thể truy cập trang shop công khai để xem sản phẩm.
- Sau khi đăng nhập, người dùng có thể thêm sản phẩm vào giỏ hàng và đặt hàng.
- Tài khoản admin có thể truy cập các trang quản trị để quản lý sản phẩm, danh mục, người dùng và đơn hàng.

## Ghi chú

- Các route quản trị yêu cầu người dùng có vai trò admin.
- Dữ liệu sản phẩm mẫu sẽ được tạo tự động sau khi chạy seeder.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Dự án này sử dụng giấy phép MIT.
