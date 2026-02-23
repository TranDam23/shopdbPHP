<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Điện thoại (category_id = 1)
            ['category_id' => 1, 'name' => 'iPhone 15 Pro Max', 'slug' => 'iphone-15-pro-max',
             'description' => 'Chip A17 Pro, camera 48MP, màn hình 6.7 inch',
             'price' => 34990000, 'stock' => 50, 'is_active' => true],

            ['category_id' => 1, 'name' => 'Samsung Galaxy S24 Ultra', 'slug' => 'samsung-s24-ultra',
             'description' => 'Snapdragon 8 Gen 3, camera 200MP, bút S Pen',
             'price' => 31990000, 'stock' => 30, 'is_active' => true],

            ['category_id' => 1, 'name' => 'Xiaomi 14 Pro', 'slug' => 'xiaomi-14-pro',
             'description' => 'Snapdragon 8 Gen 3, sạc nhanh 120W',
             'price' => 18990000, 'stock' => 40, 'is_active' => true],

            // Laptop (category_id = 2)
            ['category_id' => 2, 'name' => 'MacBook Air M3', 'slug' => 'macbook-air-m3',
             'description' => 'Chip M3, RAM 16GB, SSD 512GB, màn hình 15 inch',
             'price' => 32990000, 'stock' => 20, 'is_active' => true],

            ['category_id' => 2, 'name' => 'Dell XPS 15', 'slug' => 'dell-xps-15',
             'description' => 'Intel Core i7, RTX 4060, RAM 32GB, màn hình OLED',
             'price' => 45990000, 'stock' => 15, 'is_active' => true],

            ['category_id' => 2, 'name' => 'ASUS ROG Zephyrus G14', 'slug' => 'asus-rog-g14',
             'description' => 'AMD Ryzen 9, RTX 4070, RAM 32GB, gaming laptop',
             'price' => 38990000, 'stock' => 25, 'is_active' => true],

            // Máy tính bảng (category_id = 3)
            ['category_id' => 3, 'name' => 'iPad Pro M4', 'slug' => 'ipad-pro-m4',
             'description' => 'Chip M4, màn hình OLED 11 inch, hỗ trợ Apple Pencil Pro',
             'price' => 28990000, 'stock' => 35, 'is_active' => true],

            ['category_id' => 3, 'name' => 'Samsung Galaxy Tab S9', 'slug' => 'samsung-tab-s9',
             'description' => 'Snapdragon 8 Gen 2, màn hình AMOLED 11 inch',
             'price' => 19990000, 'stock' => 20, 'is_active' => true],

            // Tai nghe (category_id = 4)
            ['category_id' => 4, 'name' => 'AirPods Pro 2', 'slug' => 'airpods-pro-2',
             'description' => 'Chống ồn chủ động, âm thanh không gian, chip H2',
             'price' => 6490000, 'stock' => 100, 'is_active' => true],

            ['category_id' => 4, 'name' => 'Sony WH-1000XM5', 'slug' => 'sony-wh-1000xm5',
             'description' => 'Chống ồn tốt nhất, pin 30 giờ, kết nối multipoint',
             'price' => 8490000, 'stock' => 60, 'is_active' => true],

            // Đồng hồ thông minh (category_id = 5)
            ['category_id' => 5, 'name' => 'Apple Watch Series 9', 'slug' => 'apple-watch-series-9',
             'description' => 'Chip S9, màn hình Always-On, theo dõi sức khỏe',
             'price' => 11990000, 'stock' => 45, 'is_active' => true],

            ['category_id' => 5, 'name' => 'Samsung Galaxy Watch 6', 'slug' => 'samsung-watch-6',
             'description' => 'Theo dõi sức khỏe, pin 40 giờ, màn hình AMOLED',
             'price' => 7490000, 'stock' => 50, 'is_active' => true],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}