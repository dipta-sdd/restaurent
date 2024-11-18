<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'table_id',
        'reservation_time',
        'status',
        'created_by',
        'updated_by',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
