<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\course;

class courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 50; $i++)
            course::create(['course_name' => fake()->name(),
                'credit_hours' => fake()->numberBetween(1, 5),
                'course_id' => fake()->numberBetween(1, 500)]);

    }
}
