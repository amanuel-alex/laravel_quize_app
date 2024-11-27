<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Add new  User </h2>
@if (Session::has('fail'))
<span class="text-danger">{{Session::get('fail')}}</span>
    
@endif
            <form action="{{ route('user.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input 
                        type="text" 
                        id="full_name" 
                        name="full_name" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required 
                        placeholder="Enter full name @error('username')  @enderror"
                        value="{{ old('username') }}"
                        pattern="[A-Za-z\s]+"  
                        title="Username can only contain letters and spaces."
                    >
                    @error('full_name')
                        <p class="error text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required 
                        placeholder="Enter email address @error('email')  ring-red-500 @enderror" value="{{old('email')}}"
                    >
                    @error('email')
                    <p class="error text-red-500">{{ $message }}</p>
                @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required 
                        placeholder="Enter password"
                    >
                    @error('password')
                    <p class="error text-red-500">{{ $message }}</p>
                @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required 
                        placeholder="Confirm password"
                    >
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        save 
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
