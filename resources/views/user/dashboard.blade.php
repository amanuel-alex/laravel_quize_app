<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">
            <span class="capitalize">Welcome, {{ Auth::user()->username }}!</span>
            <span class="block text-lg font-light">Thank you for visiting us</span>
        </h1>
    
        <div class="flex justify-center gap-4">
            <!-- Button 1: See More Questions -->
            <a href="{{route('quize')}}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                See More Questions
            </a>
            
            <!-- Button 2: Quiz Status -->
            <a href="javascript:void(0)" id="quizStatusBtn" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                Quiz Status
            </a>
            
            <!-- Button 3: Test Yourself -->
            <a href="https://www.infobooks.org/free-pdf-books/computers/web-development/" target="_blank"  class="bg-purple-500 capitalize text-white py-2 px-4 rounded-lg hover:bg-purple-600 transition duration-300">
                Download References
            </a>
        </div>

        <div id="quizScoreContainer" class="max-w-8xl p-6 bg-white rounded-lg shadow-md mt-10 m-auto hidden">
            <h1 class="text-2xl font-bold">Your Quiz Score</h1>
            <p class="mt-4">You scored {{ session('score') ?? 0 }} out of 20.</p>
        </div>
    </div>

    <script>
        // JavaScript to toggle the quiz status section
        document.getElementById('quizStatusBtn').addEventListener('click', function() {
            var scoreContainer = document.getElementById('quizScoreContainer');
            scoreContainer.classList.toggle('hidden');  // Toggles visibility of the quiz score container
        });
    </script>
</x-layout>
