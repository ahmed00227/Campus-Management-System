<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\teacher;
class teacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1;$i<=50;$i++)
        teacher::create(['teacher_name'=>fake()->name()
            ,'email'=>fake()->email(),
            'salary'=>fake()->randomFloat(1,50000,100000)]);
    }
}
