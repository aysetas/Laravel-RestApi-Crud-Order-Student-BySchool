<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            School::create([
                'name' => Str::random(5),
            ]);
        }
    }
}
