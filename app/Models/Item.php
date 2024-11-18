<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'subcategory_id',
        'name',
        'description',
        'price',
        'image',
        'allergens',
        'dietary_options',
        'type',
        'created_by',
        'updated_by',
        'status',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
