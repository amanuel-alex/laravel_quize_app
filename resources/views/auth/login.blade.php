<x-layout>
    <div class="register-container w-[35vw] bg-orange-50 p-8 rounded-md shadow-md mx-auto">
        <h2 class="title text-2xl font-semibold text-center mb-4">Welcome to login </h2>      
        <div class="max-w-screen-sm text-left mx-auto">
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" id="email" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"  @error('email')  ring-red-500 @enderror" value="{{old('email')}}" >  
                </div>
              
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400" >
                </div>
                
                <div class="mb-4">
                    
                    <input type="checkbox" name="remember" id="remember"  >
                    <label for="remember">Remember me</label>
                </div>
                @error('failed')
                <p class="error text-red-500">{{ $message }}</p>
            @enderror
                <!-- Register Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full p-3 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-green-400">Login</button>
                </div>
            </form>

            <p>Don't have an account? <a href="{{route('register')}}" class="my-4 hover:text-rose-300">Sign Up</a></p>
            <!-- Social Login Buttons -->
            <div class="flex space-x-4 mt-6 justify-center">
                <!-- Google Button -->
                <button class="w-full sm:w-auto p-3 bg-white text-black border border-slate-300 rounded-md hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-400 flex items-center justify-center space-x-2">
                   <a href="{{route('auth.google')}}"> <img src="{{ asset('img/google-logo-24.png') }}" alt="Google" class="h-6 w-6"></a>
                </button>

                
                <!-- Github Button -->
                <button class="w-full sm:w-auto p-3 bg-white text-white border border-slate-300 rounded-md hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-black flex items-center justify-center space-x-2">
                    <a href="{{route('github.login')}}"><img src="{{ asset('img/github-logo-24.png') }}" alt="github" class="h-6 w-6"></a>
                   
                </button>
            </div>
        </div>
    </div>
</x-layout>
