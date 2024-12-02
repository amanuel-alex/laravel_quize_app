<x-layout>
    <div class="max-w-8xl p-6 bg-white rounded-lg shadow-md mt-10 m-auto">
        <div id="quiz-container" class="space-y-8 mx-2">
            <!-- Quiz Questions will be dynamically inserted here -->
        </div>

       
    </div>
    <form id="quiz-form" action="{{ route('quiz.submit') }}" method="POST" class="mt-6">
        @csrf
        <!-- Hidden input to hold the answers -->
        <input type="hidden" name="answers" id="answers">
        
        <div class="flex justify-between mt-6">
            <button id="previous" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg" disabled>Previous</button>
            <button id="next" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg">Next</button>
            <button type="submit" id="submit" class="hover:bg-slate-400 bg-green-500 text-white px-4 py-2 rounded-lg">Submit</button>
        </div>
    </form>
    <script>
        let currentQuestionIndex = 0;
let questions = [];
let answers = [];  // Track answers in this array, ensure it's properly initialized

// Fetch questions when the page loads
window.onload = function () {
    fetchQuestions();
};

// Fetch questions from the backend API
function fetchQuestions() {
    fetch('/api/questions')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('quiz-container').innerHTML = data.error;
            } else {
                questions = data;  // Store the fetched questions
                displayQuestion(currentQuestionIndex);  // Display the first question
            }
        })
        .catch(error => {
            console.error('Error fetching questions:', error);
        });
}

// Display the current question
function displayQuestion(index) {
    if (index >= 0 && index < questions.length) {
        const question = questions[index];
        const optionsHtml = `
            <ul class="space-y-2">
                <li>
                    <input type="radio" name="option_${index}" id="option_a_${index}" value="option_a" 
                    ${answers[index] === 'option_a' ? 'checked' : ''} 
                    onchange="saveAnswer(${index}, 'option_a')">
                    <label for="option_a_${index}">${question.option_a}</label>
                </li>
                <li>
                    <input type="radio" name="option_${index}" id="option_b_${index}" value="option_b" 
                    ${answers[index] === 'option_b' ? 'checked' : ''} 
                    onchange="saveAnswer(${index}, 'option_b')">
                    <label for="option_b_${index}">${question.option_b}</label>
                </li>
                <li>
                    <input type="radio" name="option_${index}" id="option_c_${index}" value="option_c" 
                    ${answers[index] === 'option_c' ? 'checked' : ''} 
                    onchange="saveAnswer(${index}, 'option_c')">
                    <label for="option_c_${index}">${question.option_c}</label>
                </li>
            </ul>
        `;

        const questionHtml = `
            <div class="question">
                <p><strong>${question.question_text}</strong></p>
                ${optionsHtml}
            </div>
        `;

        // Insert the question HTML into the quiz container
        document.getElementById('quiz-container').innerHTML = questionHtml;

        // Enable/Disable Next/Previous buttons
        document.getElementById('previous').disabled = index === 0;
        document.getElementById('next').disabled = index === questions.length - 1;
    }
}

// Save the selected answer
function saveAnswer(questionIndex, selectedOption) {
    answers[questionIndex] = selectedOption;  // Ensure answers array is updated correctly
}

// Go to the next question
document.getElementById('next').addEventListener('click', function () {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        displayQuestion(currentQuestionIndex);
    }
});

// Go to the previous question
document.getElementById('previous').addEventListener('click', function () {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        displayQuestion(currentQuestionIndex);
    }
});

// Submit the quiz
document.getElementById('quiz-form').addEventListener('submit', function (event) {
    // Convert the answers array into a JSON string and store it in the hidden input field
    document.getElementById('answers').value = JSON.stringify(answers);
});

    </script>
</x-layout>
