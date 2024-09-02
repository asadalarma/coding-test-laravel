<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use UConverter;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_POINTS = 'points';
    const PAYMENT_METHOD_CHEQUE = 'cheque';


    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id')->where('user_type', 'customer');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

}
