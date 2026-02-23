<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','order_code','total_amount','status','address','phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending'    => ['label' => 'Chờ xác nhận', 'color' => 'warning'],
            'processing' => ['label' => 'Đang xử lý',   'color' => 'info'],
            'completed'  => ['label' => 'Hoàn thành',   'color' => 'success'],
            'cancelled'  => ['label' => 'Đã hủy',       'color' => 'danger'],
        };
    }
}