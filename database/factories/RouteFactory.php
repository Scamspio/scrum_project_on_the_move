<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "stops" => '["Groningen"]',
            "departure" => "12:00",
            "date" => "2026-01-31",
            "duration" => "1903232",
            "truck_id" => 1
        ];
    }
}
