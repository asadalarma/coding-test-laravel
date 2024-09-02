<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const USER_TYPE_ADMIN = 'admin';
    const USER_TYPE_CUSTOMER = 'customer';
    const USER_TYPE_VENDOR = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'created_at',
        'updated_at'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeUserType($query, $userType){
        return $query->whereUserType($userType);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    public function scopeByEmail($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    public function scopeByOrderNumber($query, $orderNumber)
    {
        return $query->whereHas('orders', function ($q) use ($orderNumber) {
            $q->where('order_number', 'like', '%' . $orderNumber . '%');
        });
    }

    public function scopeByItemName($query, $itemName)
    {
        return $query->whereHas('orders.items', function ($q) use ($itemName) {
            $q->where('name', 'like', '%' . $itemName . '%');
        });
    }
}
