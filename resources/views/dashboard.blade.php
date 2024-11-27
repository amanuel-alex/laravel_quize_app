<x-layout>
    
    
    
    <div class="container ">
        <h1 class="capitalize">Welcome, Admin {{ Auth::user()->username }}!</h1>
        <p>Manage questions, users, and more from this dashboard.</p>
        
    <div class="grid grid-cols-3 gap-4">
        <div class="card">
            <a href="{{ route('manage.questions') }}">manage questions</a>
        </div>
        <div class="card">
            <a href="{{ route('store.create') }}">Add Question</a>
        </div>
        <div class="card">
            <a href="{{ route('user_detail') }}">manage users</a>
        </div>
       
    </div>
</div>
</x-layout>
