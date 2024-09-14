<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ajit Gurung',
            'email' => 'ajitgurung04@gmail.com',
            'password' => Hash::make('ajitgrg711'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
    }
}
