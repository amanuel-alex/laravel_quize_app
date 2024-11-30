<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-300 text-slate-900 ">
  <header class="bg-orange-50 shadow-lg fixed left-0 right-0 top-0 scrolled py-4">
    <nav class="flex justify-between items-center w-[92%] mx-auto  ">
      {{-- <img src="{{ asset('img/logo4.png') }}" alt="logo" class="w-22 h-10"> --}}
      <a href="{{ route('home') }}" class="nav-link text-lg font-semibold">AmanView</a>
  
      <div class="flex items-center gap-4  navbar" id="menuList">
        <a href="{{ route('home') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">Home</a>
        <a href="{{ route('about') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">About</a>
        <a href="{{ route('explore') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">Explore</a>
        <a href="{{ route('references') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">References</a>
        <a href="{{ route('quize') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">Quiz</a>
        <a href="{{ route('blog') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">Blog</a>
        <a href="{{ route('support') }}" class="nav-link navO text-lg font-semibold hover:text-green-700">Support</a>
      </div>
  



      <!-- Handle authenticated users (admin or user) -->
@auth
<div class="relative grid place-items-center" x-data="{ open: false }">
  <div class="flex btn cursor-pointer">
    <h6 @click="open = !open" class="username hover:text-black capitalize py-2 ">{{ auth()->user()->username }}</h6>
    <i class="bx bx-menu toggleMenu" onclick="toggleMenu()"></i>
  </div>
  <div x-show="open" @click.outside="open = false" class="absolute top-14 px-4 py-5 right-0 overflow-hidden rounded-lg bg-slate-200 shadow-lg">
    <p class="email mb-4 ">{{ auth()->user()->email }}</p>

    @if(auth()->user()->role === 'user')
    <a href="{{ route('user.dashboard') }}" class="dashboard mb-8 hover:text-slate-400">User Dashboard</a>
   
@elseif(auth()->user()->role === 'admin')
<a href="{{ route('admin.dashboard') }}" class="dashboard mb-8 hover:text-slate-400">Admin Dashboard</a>
@endif

    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="block mt-4 w-full text-left hover:text-slate-400">Logout</button>
    </form>
  </div>
</div>
@endauth

<!-- Handle guest users (not authenticated) -->
@guest
<div class="flex items-center gap-6" x-data="{ showRoleSelection: false, selectedRole: null }">
  <!-- Sign Up Button: only visible if no role is selected -->
  <button 
    @click="showRoleSelection = true" 
    class="nav-link text-lg font-semibold hover:text-green-600" 
    x-show="!selectedRole && !showRoleSelection"
  >
    Sign Up
  </button>

  <div 
    x-show="showRoleSelection" 
    @click.away="showRoleSelection = false" 
    class="absolute top-14 right-0 p-4 bg-white shadow-lg rounded-lg"
  >
    <h3 class="font-semibold mb-2">Select an option</h3>
    <ul>
      <li>
        <a 
          href="#" 
          @click="selectedRole = 'admin'; showRoleSelection = false" 
          class="text-lg hover:text-green-600"
        >
          Admin
        </a>
      </li>
      <li>
        <a 
          href="#" 
          @click="selectedRole = 'user'; showRoleSelection = false" 
          class="text-lg hover:text-green-600"
        >
          User
        </a>
      </li>
    </ul>
  </div>

  <!-- For User role -->
  <div x-show="selectedRole === 'user'" class="flex items-center gap-6 registered" id="registerList">
    <a href="{{ route('login') }}" class="nav-link text-lg font-semibold hover:text-green-600 register">Login</a>
    <a href="{{ route('register') }}" class="nav-link text-lg font-semibold hover:text-green-600 rounded register">Sign Up</a>
  </div>

  <!-- For Admin role -->
  <div x-show="selectedRole === 'admin'" class="flex items-center gap-6 registered" id="registerList">
    <a href="{{ route('adminLogin') }}" class="nav-link text-lg font-semibold hover:text-green-600 register">Login</a>
    <a href="{{ route('adminRegister') }}" class="nav-link text-lg font-semibold hover:text-green-600 rounded register">Sign Up</a>
  </div>
</div>
@endguest   
    </nav>
  </header>
  

   <main class="py-8 px-4 mx-auto my-20 max-w-screen-lg ">
     {{$slot}}
   </main>

   <footer class="bg-[#123456] py-8">
    <div class="container mx-auto px-6 sm:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Social Media part -->
            <div class="social-media">
                <h3 class="text-lg font-semibold mb-4 text-rose-400">Follow Us</h3>
                <ul class="flex space-x-4 text-lg">
                    <li><a href="#" class="hover:text-blue-400"><i class='bx bg-white text-lg rounded-lg p-2 bxl-facebook'></i></a></li>
                    <li><a href="#" class="text-blue-400 hover:text-blue-300"><i class='bx bg-white text-lg rounded-lg p-2 bxl-github'></i></a></li>
                    <li><a href="#" class="text-pink-600 hover:text-pink-400"><i class='bx bg-white text-lg rounded-lg p-2 bxl-linkedin'></i></a></li>
                    <li><a href="#" class="text-blue-700 hover:text-blue-500"><i class='bx bg-white text-lg rounded-lg p-2 bxl-gmail'></i></a></li>
                </ul>
            </div>

            <!-- Quick Links Section -->
            <div class="quick-links">
                <h3 class="text-lg font-semibold mb-4 text-rose-400">Quick Links</h3>
                <ul class="space-y-2 text-md">
                    <li><a href="{{ route('home') }}" class="hover:text-green-400 navOs text-blue-400">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-green-400 navOs text-blue-400">About</a></li>
                    <li><a href="{{ route('explore') }}" class="hover:text-green-400 navOs text-blue-400">Explore</a></li>
                    <li><a href="{{ route('references') }}" class="hover:text-green-400 navOs text-blue-400">References</a></li>
                    <li><a href="{{ route('quize') }}" class="hover:text-green-400 navOs text-blue-400">Quiz</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-green-400 navOs text-blue-400">Blog</a></li>
                    <li><a href="{{ route('support') }}" class="hover:text-green-400 navOs text-blue-400">Support</a></li>
                </ul>
            </div>

            <!-- About Us Section -->
            <div class="about-us">
                <h3 class="text-lg font-semibold mb-4 text-white">About Us</h3>
                <p class="text-md text-center border sm:ml-8 md:px-12 lg:px-16 rounded-lg ">
                    Our mission is to create deliverable products that are not only functional but also intuitive and impactful. We specialize in developing mobile apps, web platforms, and AI-powered systems.
                </p>
            </div>
        </div>

        <!-- Footer Bottom Section -->
        <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm">
            <p class="text-white">&copy; {{ date('Y') }} All rights reserved.</p>
        </div>
    </div>
</footer>



<script src="https://kit.fontawesome.com/a076d05399.js"></script>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
   
   window.addEventListener('scroll', function () {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {  // When scrolled more than 50px
        header.classList.add('scrolled');  // Add the 'scrolled' class
    } else {
        header.classList.remove('scrolled');  // Remove the 'scrolled' class when not scrolling
    }
});


// Toggle menu visibility for mobile
function toggleMenu() {
  const menuList = document.getElementById("menuList");
  const registerList = document.getElementById("registerList");

  // Toggle the menu
  if (menuList.style.maxHeight === "0px" || menuList.style.maxHeight === "") {
    menuList.style.maxHeight = "800px"; // Set it to a height that suits your menu
  } else {
    menuList.style.maxHeight = "0px";
  }

  // Toggle the register list visibility (same as the menu)
  if (registerList.style.maxHeight === "0px" || registerList.style.maxHeight === "") {
    registerList.style.maxHeight = "500px"; // Adjust for your register section
  } else {
    registerList.style.maxHeight = "0px";
  }
}


   </script>
   
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script>
       const nextButton = document.getElementById('next');
       const previousButton = document.getElementById('previous');
       const quizContainer = document.getElementById('quiz-container');
       let currentPage = 1;  // Start with page 1

       // Function to load questions from the Laravel API
       function loadQuestions(page) {
           // Make a GET request to the Laravel backend to get quiz questions
           axios.get(`/quiz/questions?page=${page}`)
               .then(response => {
                   const questions = response.data;  // This is the JSON data

                   // Clear any previous questions from the container
                   quizContainer.innerHTML = ''; 

                   // Loop through each question and display it
                   questions.forEach((question, index) => {
                       const questionElement = document.createElement('div');
                       questionElement.classList.add('space-y-4');

                       const questionText = document.createElement('p');
                       questionText.classList.add('text-xl', 'font-semibold');
                       questionText.textContent = `${index + 1}. ${question.question_text}`;
                       questionElement.appendChild(questionText);

                       // Loop through the options and create radio buttons
                       ['option_a', 'option_b', 'option_c'].forEach(option => {
                           const optionLabel = document.createElement('label');
                           optionLabel.classList.add('block', 'ml-2');
                           optionLabel.innerHTML = `
                               <input type="radio" name="question-${question.id}" value="${question[option]}" class="mr-2">
                               ${question[option]}
                           `;
                           questionElement.appendChild(optionLabel);
                       });

                       // Append the question to the quiz container
                       quizContainer.appendChild(questionElement);
                   });

                   // Disable the "Previous" button if we're on the first page
                   previousButton.disabled = page <= 1;

                   // Disable the "Next" button if there are fewer than 3 questions (meaning it's the last page)
                   nextButton.disabled = questions.length < 3;
               })
               .catch(error => {
                   console.error("Error loading questions:", error);
               });
       }

       // Event listener for the "Next" button
       nextButton.addEventListener('click', () => {
           currentPage++;
           loadQuestions(currentPage);  // Load the next set of questions
       });

       // Event listener for the "Previous" button
       previousButton.addEventListener('click', () => {
           currentPage--;
           loadQuestions(currentPage);  // Load the previous set of questions
       });

       // Load the first set of questions when the page loads
       loadQuestions(currentPage);
   </script>

</body>
</html>
