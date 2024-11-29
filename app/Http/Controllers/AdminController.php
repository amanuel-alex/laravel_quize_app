<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');  // Show the admin dashboard
    }

    public function create()
    {
        return view('admin.create');  // Show the form to create an admin resource
    }

    // Constructor to ensure only admin has access to the methods
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }

    // // Display a list of all questions (admin only)
    // public function manageQuestions()
    // {
    //     $this->authorize('view question');  // Make sure the admin has permission

    //     $questions = Question::all();
    //     return view('admin.questions.index', compact('questions'));
    // }

    // // Show form to create a new question
    // public function createQuestion()
    // {
    //     $this->authorize('add question');  // Check permission

    //     return view('admin.questions.create');
    // }

    // // Store a new question
    // public function storeQuestion(Request $request)
    // {
    //     $this->authorize('add question');

    //     // Validate the input
    //     $request->validate([
    //         'question' => 'required|string',
    //         'answer' => 'required|string',
    //     ]);

    //     // Store the new question
    //     Question::create([
    //         'question' => $request->question,
    //         'answer' => $request->answer,
    //     ]);

    //     return redirect()->route('admin.questions.index')->with('success', 'Question added successfully');
    // }

    // // Edit an existing question
    // public function editQuestion($id)
    // {
    //     $this->authorize('edit question');

    //     $question = Question::findOrFail($id);
    //     return view('admin.questions.edit', compact('question'));
    // }

    // // Update an existing question
    // public function updateQuestion(Request $request, $id)
    // {
    //     $this->authorize('edit question');

    //     $request->validate([
    //         'question' => 'required|string',
    //         'answer' => 'required|string',
    //     ]);

    //     $question = Question::findOrFail($id);
    //     $question->update([
    //         'question' => $request->question,
    //         'answer' => $request->answer,
    //     ]);

    //     return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully');
    // }

    // // Delete a question
    // public function deleteQuestion($id)
    // {
    //     $this->authorize('delete question');

    //     $question = Question::findOrFail($id);
    //     $question->delete();

    //     return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully');
    // }
}
