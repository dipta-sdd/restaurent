<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
