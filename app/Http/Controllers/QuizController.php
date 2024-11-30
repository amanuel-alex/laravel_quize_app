<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
        // Path to the questions JSON file
        $filePath = storage_path('app/public/questions.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Questions file not found!'], 404);
        }

        // Get the content of the JSON file
        $jsonContent = file_get_contents($filePath);

        // Decode the JSON content into an array
        $questions = json_decode($jsonContent, true);

        if (empty($questions)) {
            return response()->json(['error' => 'No questions found in the JSON file!'], 404);
        }

        // Return the questions as JSON
        return response()->json($questions);
    }
}
