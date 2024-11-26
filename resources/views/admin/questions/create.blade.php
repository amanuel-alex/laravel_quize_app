@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Question</h1>

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="question" class="block">Question</label>
            <textarea name="question" id="question" class="form-input w-full" required></textarea>
        </div>

        <div class="mb-4">
            <label for="answer" class="block">Answer</label>
            <textarea name="answer" id="answer" class="form-input w-full" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Question</button>
    </form>
</div>
@endsection
