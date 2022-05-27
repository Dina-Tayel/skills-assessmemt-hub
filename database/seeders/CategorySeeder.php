<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->has(
    Skill::factory()->has(
        Exam::factory()->has(
            Question::factory()->count(15),
        )->count(2) 
        )->count(8)       
    )->count(5)->create();
    }
}
// Category::factory()->has(
//     Skill::factory()->has(
//         Exam::factory()->has(
//             Question::factory()->count(15),
//         )->count(2) 
//         )->count(8)       
//     )->count(5)->create();