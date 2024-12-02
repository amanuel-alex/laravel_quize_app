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
        $userAnswers = json_decode($request->input('answers'), true);
        $questions = json_decode(file_get_contents(storage_path('app/public/questions.json')), true);

        $score = 0;

        // Ensure all questions are answered
        if (count($userAnswers) !== count($questions)) {
            return response()->json([
                'success' => false,
                'message' => 'Please answer all questions.',
            ], 400);
        }

        // Check answers
        foreach ($questions as $index => $question) {
            $correctAnswer = $question['correct_option'];
            if ($userAnswers[$index] === $correctAnswer) {
                $score++;
            }
        }

        // Store the score in session
        session(['score' => $score]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Quiz submitted successfully!',
            'score' => $score,
        ]);
    }
}
