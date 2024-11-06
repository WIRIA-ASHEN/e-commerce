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
        'snaptoken' 
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getSnapToken()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $this->id,
                'gross_amount' => $this->total,
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'total' => $this->id,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $this->update(['snaptoken' => $snapToken]);

        return $snapToken;
    }
}
