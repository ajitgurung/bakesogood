<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'category_id', 'status', 'featured', 'dis_price', 'dis_per', 'price', 'image', 'order'
    ];
}
