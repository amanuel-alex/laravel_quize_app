<x-layout>
    
 


<div class="container">
    <h1>Welcome, Admin {{ Auth::user()->username }}!</h1>
    <p>Manage questions, users, and more from this dashboard.</p>

    <div class="grid grid-cols-3 gap-4">
        <div class="card">
            <a href="{{ route('admin.questions.create') }}">Add Question</a>
        </div>
        <div class="card">
            <a href="{{ route('admin.users.index') }}">View Users</a>
        </div>
        <div class="card">
            <a href="{{ route('admin.recommendations.index') }}">Send Recommendations</a>
        </div>
        <div class="card">
            <a href="{{ route('admin.upload.index') }}">Upload Files</a>
        </div>
    </div>
</div>
</x-layout>
