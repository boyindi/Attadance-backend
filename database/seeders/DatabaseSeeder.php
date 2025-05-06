<?php

namespace Database\Seeders;

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
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@1.com',
            'password' =>Hash::make('12345678'),
        ]);

        // data dumy for company
        \App\Models\Company::factory()->create([
            'name' => 'PT regware technology',
            'email' => 'boyindi@gmail.com',
            'address' => 'Jl. Raya dewa ujung no 1 ciracas jakarta timur',
            'latitude' => '	-6.323116',
            'longitude' => '	106.870941',
            'radius_km' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);



    }
}
