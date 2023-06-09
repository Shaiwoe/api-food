<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Transaction;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cellphone',
        'otp',
        'login_token',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function profiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function getLatestProfileAttribute()
    {
        return $this->hasOne(UserProfile::class)
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function members()
    {
        return $this->hasMany(UserMember::class);
    }
}
