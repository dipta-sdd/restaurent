<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'created_by',
        'updated_by',
    ];

    // Define relationships with other models if needed
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
