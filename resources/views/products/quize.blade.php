<x-layout>
 <!-- resources/views/products/quize.blade.php -->
<div class="max-w-8xl  p-6 bg-white rounded-lg shadow-md mt-10 m-auto">
  <div id="quiz-container" class="space-y-8 mx-2">
      <!-- Quiz Questions will be dynamically inserted here -->
  </div>

  <div class="flex justify-between mt-6">
      <button id="previous" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg" disabled>Previous</button>
      <button id="next" class=" hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg">Next</button>
  </div>
</div>

<script>
  let currentQuestionIndex = 0;
  let questions = [];

  // Fetch questions when the page loads
  window.onload = function() {
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
                  questions = data; // Store the fetched questions
                  displayQuestion(currentQuestionIndex); // Display the first question
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
          const questionHtml = `
              <div class="question">
                  <p><strong>${question.question_text}</strong></p>
                  <ul class="space-y-2">
                      <li><input type="radio" name="option" id="option_a" value="a"> ${question.option_a}</li>
                      <li><input type="radio" name="option" id="option_b" value="b"> ${question.option_b}</li>
                      <li><input type="radio" name="option" id="option_c" value="c"> ${question.option_c}</li>
                  </ul>
              </div>
          `;

          // Insert the question HTML into the quiz container
          document.getElementById('quiz-container').innerHTML = questionHtml;

          // Enable/Disable Next/Previous buttons
          document.getElementById('previous').disabled = index === 0;
          document.getElementById('next').disabled = index === questions.length - 1;
      }
  }

  // Go to the next question
  document.getElementById('next').addEventListener('click', function() {
      if (currentQuestionIndex < questions.length - 1) {
          currentQuestionIndex++;
          displayQuestion(currentQuestionIndex);
      }
  });

  // Go to the previous question
  document.getElementById('previous').addEventListener('click', function() {
      if (currentQuestionIndex > 0) {
          currentQuestionIndex--;
          displayQuestion(currentQuestionIndex);
      }
  });
</script>

</x-layout>
