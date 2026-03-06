<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\Route;
use App\Models\Truck;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Truck::factory(3)
            ->sequence(
                ["name" => "AB-12-34"],
                ["name" => "23-BC-45"],
                ["name" => "34-56-CB"]
            )
            ->create();

        Company::factory()->create();

        Address::factory()->create();
    }
}
