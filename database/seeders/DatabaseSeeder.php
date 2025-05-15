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

        // User::factory(10)->create();

        User::factory()->create([
             'name' => 'Aya Sabry',
            'email' => 'aya@example.com',
            'password' => Hash::make('ayota2002#'),
        ]);
        //$this->call(PostWithCommentsSeeder::class);
    }
}
