<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
