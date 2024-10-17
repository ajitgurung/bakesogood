<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
            'order_id',
            'name',
            'email',
            'address_line_1',
            'country',
            'state',
            'city',
            'postal_code',
            'phone_number',
            'address_type'
    ];
}
