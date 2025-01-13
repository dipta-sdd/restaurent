<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone',
        'verified_at',
        'social_id',
        'created_by',
        'updated_by',
        'status_id',
        'is_admin',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'otp_exp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_active()
    {
        return $this->status == 'active';
    }
    public function is_admin()
    {
        return in_array($this->role, ['admin', 'manager', 'staff', 'rider']);
    }
    public function is_rider()
    {
        return $this->role === 'rider';
    }
    public function is_customer()
    {
        return $this->role === 'user';
    }
    public function is_super_admin()
    {
        return $this->role === 'admin';
    }
}
