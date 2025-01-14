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

    const STATUS_AVAILABLE = 'available';
    const STATUS_MAINTENANCE = 'maintenance';
    const STATUS_CLOSED = 'closed';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_MAINTENANCE => 'Maintenance',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
