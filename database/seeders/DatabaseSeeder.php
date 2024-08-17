<?php

namespace Database\Seeders;

use App\Models\CV;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Artūrs',
            'last_name' => 'Melnis',
            'email' => 'artmelnis@gmail.com',
            'password' => Hash::make('qwerty123'),
        ]);
        CV::factory(20)->create([
            'user_id' => $user->id,
        ]);



    }
}
