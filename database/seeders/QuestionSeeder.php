<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::create([
            'question_text' => 'What is the capital of France?',
            'option_a' => 'Berlin',
            'option_b' => 'Madrid',
            'option_c' => 'Paris',
            'correct_option' => 'Paris',
        ]);

        Question::create([
            'question_text' => 'What is the capital of Germany?',
            'option_a' => 'Berlin',
            'option_b' => 'Madrid',
            'option_c' => 'Paris',
            'correct_option' => 'Berlin',
        ]);
    }
}
