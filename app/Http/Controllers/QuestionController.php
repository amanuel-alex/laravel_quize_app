<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        // Return the view to create a question
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        // Validate and store question and answer
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $question = new Question();
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->save();

        return redirect()->route('admin.dashboard')->with('success', 'Question added successfully!');
    }
}
