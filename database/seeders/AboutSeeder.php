<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'description' => 'Our story began...',
            'why_us' => [
                ['title' => 'Quality', 'description' => 'We provide quality...', 'icon_class' => 'fas fa-award'],
                // Add more items if necessary
            ],
            'image' => null, // Image can be added via the Filament panel
        ]);
    }
}
