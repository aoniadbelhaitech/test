<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\periodStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Teacher::factory(10)->create();
        Student::factory(90)->create();
        Period::factory(50)->create();
        periodStudent::factory(50)->create();

    }
}
