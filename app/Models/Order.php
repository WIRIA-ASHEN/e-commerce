<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Midtrans\Snap;
use Midtrans\Config;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'snaptoken' // Tambahkan ini jika belum ada di fillable
    ];

    /**
     * Relasi ke tabel user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel order_items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Mendapatkan Snap Token dari Midtrans.
     */
    public function getSnapToken()
    {
        // Konfigurasi Midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Parameter untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $this->id,
                'gross_amount' => $this->total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        // Dapatkan Snap Token dari Midtrans

        $snapToken = Snap::getSnapToken($params);
        $this->update(['snaptoken' => $snapToken]);

        return $snapToken;
    }
}
