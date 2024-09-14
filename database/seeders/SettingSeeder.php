<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        DB::table('settings')->insert([
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'site_title' => 'Goodies',
            'site_email' => 'info@yoursite.com',
            'site_keyword' => 'About Your Site',
            'facebook_url' => 'https://www.facebook.com/',
            'youtube_url' => 'https://twitter.com/',
            'twitter_url' => 'https://www.linkedin.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'phone' => '9800000000',
            'mobile' => '9800000000',
            'fax' => '4422',
            'address' => 'Toronto, CA',
            'google_map_url' => 'google_map_url',
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
    }
}
