<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "logo", "favicon", "site_title", "site_email", "reservation_email", "sales_email", "facebook_url", "twitter_url", "instagram_url", "youtube_url", "linkedin_url", "other_url", "phone", "phone2", "mobile", "mobile_whatsapp", "fax", "address", "site_keyword", "advance_amount", "google_map_url", "og_title", "og_description", "og_image", "meta_title", "meta_description", "meta_keywords"
    ];
}
