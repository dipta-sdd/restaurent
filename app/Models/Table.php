<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'capacity',
        'status',
        'created_by',
        'updated_by',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
