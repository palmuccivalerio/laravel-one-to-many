<?php

namespace Database\Seeders;
use App\Models\Type; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $newType = new Type();
            $newType ->name = $faker->sentence(3);
            $newType ->color = $faker->sentence(3);
            $newType ->save();
    }
}
}