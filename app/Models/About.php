<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = ['description', 'why_us', 'image'];

    protected $casts = [
        'why_us' => 'array',
    ];
}
