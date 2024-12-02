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
            <button type="button" id="previous" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg" disabled>Previous</button>
            <button type="button" id="next" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg">Next</button>
            <button type="submit" id="submit" class="hover:bg-slate-400 bg-green-500 text-white px-4 py-2 rounded-lg hidden">Submit</button>
        </div>
    </form>

    <div id="success-message" class="hidden mt-6 p-4 bg-green-500 text-white rounded-lg text-center">
        Quiz Submitted Successfully!
    </div>

    <script>
        let currentQuestionIndex = 0;
        let questions = [];
        let answers = [];  // Track answers in this array

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

                // Enable/Disable Next/Previous buttons based on the current index
                document.getElementById('previous').disabled = index === 0;
                document.getElementById('next').disabled = index === questions.length - 1;

                // Show/Hide submit button on last question
                const submitButton = document.getElementById('submit');
                if (index === questions.length - 1) {
                    submitButton.classList.remove('hidden'); // Show submit button on last question
                } else {
                    submitButton.classList.add('hidden'); // Hide submit button on other questions
                }
            }
        }

        // Save the selected answer
        function saveAnswer(questionIndex, selectedOption) {
            answers[questionIndex] = selectedOption;  // Store the answer in the answers array
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
                currentQuestionIndex--;  // Decrement the question index
                displayQuestion(currentQuestionIndex);  // Display the previous question
            }
        });

        // Handle form submission with AJAX
        document.getElementById('quiz-form').addEventListener('submit', function (event) {
    event.preventDefault();  // Prevent the default form submission behavior

    // Convert the answers array into a JSON string and store it in the hidden input field
    document.getElementById('answers').value = JSON.stringify(answers);

    // Submit the form data via AJAX
    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())  // Parse the JSON response
    .then(data => {
        if (data.success) {
            // Redirect to user dashboard with success
            window.location.href = "{{ route('user.dashboard') }}"; // Redirect to dashboard

            // Optionally, you can also show a success message here if needed
            document.getElementById('success-message').classList.remove('hidden');
            document.getElementById('success-message').innerHTML = `Quiz Submitted Successfully! Score: ${data.score}`;
        } else {
            // Handle errors
            alert(data.message || 'There was an error submitting your quiz. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error submitting quiz:', error);
        alert('There was an error submitting your quiz. Please try again.');
    });
});

    </script>
</x-layout>
