<x-layout>
    <section class="bg-slate-200 text-white py-20 text-center">
      <div class="container mx-auto">
          <h2 class="text-4xl font-bold mb-4">Welcome to our web</h2>
          <p class="text-xl mb-6">Get, expert, and explore the world of wisdom simply and easily.</p>
          <a href="/explore" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-yellow-400 transition-all">Explore Now</a>
      </div>
    </section>
  
    <!-- Featured Cryptos Section -->
    <section class="container mx-auto py-12">
      <h2 class="text-3xl font-semibold text-center mb-6">Featured Cryptocurrencies</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Crypto Card 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-semibold mb-2">Laravel</h3>
            <p class="text-gray-500 mb-2">Create something new</p>
            <p class="text-green-500">In (24h)</p>
            <div class="mt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">View More</button>
            </div>
        </div>
        <!-- Crypto Card 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-semibold mb-2">Learn Python</h3>
            <p class="text-gray-500 mb-2">Create game</p>
            <p class="text-red-500">In (24h)</p>
            <div class="mt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">View More</button>
            </div>
        </div>
        <!-- Crypto Card 3 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-semibold mb-2">Flutter</h3>
            <p class="text-gray-500 mb-2">Start learning</p>
            <p class="text-green-500">(24h)</p>
            <div class="mt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">View More</button>
            </div>
        </div>
        <!-- Crypto Card 4 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-semibold mb-2">React Native</h3>
            <p class="text-gray-500 mb-2">Become expert</p>
            <p class="text-yellow-500">In (24h)</p>
            <div class="mt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">View More</button>
            </div>
        </div>
      </div>
    </section>
  
    <!-- How It Works Section -->
    <section class="bg-slate-200 py-12 px-2">
      <div class="container mx-auto text-center">
          <h2 class="text-3xl font-semibold mb-6">How Our Web Works</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
              <!-- Step 1 -->
              <div class="bg-white p-6 rounded-lg shadow-lg">
                  <h3 class="text-xl font-semibold mb-4">Step 1: Create an Account</h3>
                  <p class="text-gray-500">Sign up quickly to start exploring and managing your account.</p>
              </div>
              <!-- Step 2 -->
              <div class="bg-white p-6 rounded-lg shadow-lg">
                  <h3 class="text-xl font-semibold mb-4">Step 2: Start Learning</h3>
                  <p class="text-gray-500">Browse through hundreds of references and quizzes, track performance in real-time.</p>
              </div>
              <!-- Step 3 -->
              <div class="bg-white p-6 rounded-lg shadow-lg">
                  <h3 class="text-xl font-semibold mb-4">Step 3: Trade & Invest</h3>
                  <p class="text-gray-500">Make secure transactions, invest in top-performing assets, and stay updated with the latest trends.</p>
              </div>
          </div>
      </div>
    </section>
  
    
  
    <!-- Subscribe Section -->
    <section class="bg-orange-100 mb-8 text-black py-12 text-center">
      <h2 class="text-3xl font-semibold mb-4">Stay Updated with Our Latest Courses</h2>
      <p class="text-lg mb-6">Subscribe to our newsletter to receive the latest news, courses, and updates directly to your inbox.</p>
      <div class="flex justify-center">
          <form action="/subscribe" method="POST" class="flex items-center space-x-4">
              <input type="email" name="email" class="px-4 py-3 outline-none border-2 border-green-500 rounded-lg text-gray-900" placeholder="Enter your email" required>
              <button type="submit" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-all">Subscribe</button>
          </form>
      </div>
    </section>
    <!-- Call to Action Section -->
    <section class="bg-green-900 text-white py-12 text-center">
        <h2 class="text-3xl text-slate-200 font-semibold mb-4">Ready to Start Learning?</h2>
        <p class="text-xl mb-6 text-slate-200 ">Join thousands of students who are already taking the most of our Courses.</p>
        <a href="{{route('register')}}" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-yellow-400 transition-all">Get Started</a>
      </section>
    
  </x-layout>
  