<x-layout>
    <div class="register-container w-[35vw] bg-orange-50 p-8 rounded-md shadow-md mx-auto">
        <h2 class="title text-2xl font-semibold text-center mb-4">Welcome to admin login </h2>      
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

            <p class="link_element">Don't have an account? <a href="{{route('register')}}" class="my-4 hover:text-rose-300">Sign Up</a></p>
          
            
        </div>
    </div>
</x-layout>
