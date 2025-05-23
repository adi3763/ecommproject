<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        'full_name',
        'phone',
        'address_line_1',
        'state',
        'city',
        'pincode',
        'type',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
