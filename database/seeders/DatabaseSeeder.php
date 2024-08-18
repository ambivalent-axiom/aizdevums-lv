<?php

namespace Database\Seeders;

use App\Models\CV;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\License;
use App\Models\Skill;
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
        $cvs = CV::factory(1)->create([
            'user_id' => $user->id,
        ]);

        $cvs->each(function ($cv) {
            Education::factory(2)->create([
                'cv_id' => $cv->id,
            ]);
            Experience::factory(3)->create([
                'cv_id' => $cv->id,
            ]);
            Language::factory(2)->create([
                'cv_id' => $cv->id,
            ]);
            License::factory(2)->create([
                'cv_id' => $cv->id,
            ]);
            Skill::factory(2)->create([
                'cv_id' => $cv->id,
            ]);
        });





    }
}
