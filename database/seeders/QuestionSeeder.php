<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Database\Factories\AnswerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()->count(20)->create();  
    }
}
