<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_type',
        'status',
        'instructions',
        'total_amount',
        'address_id',
        'transaction_id',
        'payment_method_id',
        'reservation_id',
        'created_by',
        'updated_by',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
