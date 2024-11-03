<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'gambar', 'description', 'price', 'stock', 'is_active',
    ];

    /**
     * Relasi ke tabel order_items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
