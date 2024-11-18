<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'item_id',
        'name',
        'price',
        'status',
        'created_by',
        'updated_by',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
