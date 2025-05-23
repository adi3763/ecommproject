<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;
use App\Models\OrderItems;

class Orders extends Model
{

    //
    protected $fillable = [
        'user_id',
        'address_id',
        'payment_method',
        'status',
        'order_status',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
