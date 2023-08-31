<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_ids = \App\Models\Question::all()->pluck('id');

        foreach ($question_ids as $question_id) {
            Answer::factory()->count(3)->create(['question_id' => $question_id, 'is_true' =>0]); // This will create an answer for each question
            Answer::factory()->create(['question_id' => $question_id, 'is_true' =>1]);
        }
    }
}