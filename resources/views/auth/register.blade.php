<x-layout>
    <div class="register-container w-[35vw] bg-white p-8 rounded-md shadow-md mx-auto">
        <h2 class="title text-2xl font-semibold text-center mb-4">Welcome to registration</h2>
        <div class="max-w-screen-sm text-left mx-auto">

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                    <input type="text" name="username" id="username" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 @error('username') ring-red-500 @enderror"
                        value="{{ old('username') }}"
                        pattern="[A-Za-z\s]+"  
                        title="Username can only contain letters and spaces.">
                    
                    @error('username')
                        <p class="error text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="text" name="email" id="email" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400  @error('email')  ring-red-500 @enderror" value="{{old('email')}}" >
                    @error('email')
                    <p class="error  text-red-500">{{$message}}</p>
                @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400  @error('password') ring-red-500 @enderror" >
                    @error('password')
                    <p class="error text-red-500 ">{{$message}}</p>
                @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input w-full p-2 mt-1 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400  @error('password') ring-red-500 @enderror" >
                   
                </div>

                <!-- Register Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full p-3 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">Register</button>
                </div>
                <p>Already have account ? <a  href="{{route('login')}}" class="hover:text-rose-300">login</a></p>
            </form>

           
            </div>
        </div>
    </div>
</x-layout>
