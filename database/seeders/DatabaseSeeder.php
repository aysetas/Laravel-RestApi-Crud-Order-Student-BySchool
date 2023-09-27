<?php

namespace Database\Seeders;


use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        School::factory()
            ->count(10)
            ->create();
        Student::factory()
            ->count(10)
            ->create();

//        $this->call([
//            SchoolSeeder::class,
//            StudentSeeder::class,
//        ]);
    }
}
