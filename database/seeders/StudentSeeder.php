<?php

namespace Database\Seeders;


use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = School::inRandomOrder()->first();

        for ($i = 0; $i < 10; $i++) {
            Student::create([
                'name' => Str::random(10),
                'school_id' => $school->id,
                'order' => mt_rand(1, 9),
            ]);
        }

    }

}
