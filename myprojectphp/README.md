# ShopDB PHP

Đây là một ứng dụng thương mại điện tử đơn giản được xây dựng bằng Laravel, cho phép người dùng duyệt sản phẩm, thêm vào giỏ hàng, đặt hàng và quản lý hồ sơ cá nhân. Ngoài ra, hệ thống còn hỗ trợ các chức năng quản trị cho admin như quản lý sản phẩm, danh mục, người dùng và đơn hàng.

## Tính năng chính

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

## Công nghệ sử dụng

- PHP 8.2
- Laravel 12
- Bootstrap 5
- Vite
- SQLite (mặc định trong file cấu hình mẫu)
- Pest cho testing

## Cấu trúc dự án

- app/Http/Controllers: xử lý các request và logic nghiệp vụ
- app/Models: các model như Product, Category, Order, User, Cart
- database/migrations: schema cơ sở dữ liệu
- database/seeders: dữ liệu mẫu cho danh mục và sản phẩm
- resources/views: giao diện Blade
- routes/web.php: định nghĩa route chính

## Yêu cầu hệ thống

- PHP 8.2+
- Composer
- Node.js và npm

## Hướng dẫn cài đặt

1. Clone repository:

```bash
git clone <your-repo-url>
cd myprojectphp
```

2. Cài đặt PHP dependencies:

```bash
composer install
```

3. Tạo file môi trường:

```bash
cp .env.example .env
php artisan key:generate
```

4. Tạo database SQLite (nếu sử dụng cấu hình mặc định):

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

Dự án này sử dụng giấy phép MIT.
