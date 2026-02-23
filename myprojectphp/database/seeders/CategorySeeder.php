<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại',   'slug' => 'dien-thoai'],
            ['name' => 'Laptop',        'slug' => 'laptop'],
            ['name' => 'Máy tính bảng', 'slug' => 'may-tinh-bang'],
            ['name' => 'Tai nghe',      'slug' => 'tai-nghe'],
            ['name' => 'Đồng hồ thông minh', 'slug' => 'dong-ho-thong-minh'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}