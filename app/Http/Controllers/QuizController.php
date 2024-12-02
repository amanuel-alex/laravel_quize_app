<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    // Method to render the quiz page
    public function showQuizPage()
    {
        return view('products.quize');  // Render the quiz Blade view
    }

    // Method to get questions from the JSON file
    public function getQuestions()
    {
        $filePath = storage_path('app/public/questions.json');
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Questions file not found!'], 404);
        }

        // Get the content of the JSON file
        $jsonContent = file_get_contents($filePath);
        $questions = json_decode($jsonContent, true);

        if (empty($questions)) {
            return response()->json(['error' => 'No questions found in the JSON file!'], 404);
        }

        return response()->json($questions);
    }

    // Method to handle quiz submission and calculate score
    public function submitQuiz(Request $request)
    {
        // Decode the answers from the hidden input field (which is a JSON string)
        $userAnswers = json_decode($request->input('answers'), true);

        // Get the questions from the JSON file
        $questions = json_decode(file_get_contents(storage_path('app/public/questions.json')), true);

        $score = 0;

        // Check if the user has answered all questions
        if (count($userAnswers) !== count($questions)) {
            return back()->withErrors('Please answer all questions.');
        }

        foreach ($questions as $index => $question) {
            // Check if the answer exists for this question
            if (!isset($userAnswers[$index])) {
                return back()->withErrors('Some questions were not answered.');
            }

            // Check if the answer is correct
            $correctAnswer = $question['correct_option'];  // The correct option in the JSON
            $userAnswer = $userAnswers[$index];

            if ($userAnswer === $correctAnswer) {
                $score++;
            }
        }

        // Redirect the user to the dashboard with their score
        return redirect()->route('dashboard')->with('score', $score);
    }
}
