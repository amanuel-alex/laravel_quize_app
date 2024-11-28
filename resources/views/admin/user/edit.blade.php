<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Edit  User </h2>
@if (Session::has('fail'))
<span class="text-danger">{{Session::get('fail')}}</span>
    
@endif
            <form action="{{ route('user.edit') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="{{$user->id}}">
                <div class="mb-4">
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input 
                        type="text" 
                        id="full_name" 
                        name="full_name"  value="{{ $user->name }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required 
                        placeholder="Enter full name @error('username')  @enderror"
                       
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
                        placeholder="Enter email address @error('email')  ring-red-500 @enderror" value="{{ $user->email }}"
                    >
                    @error('email')
                    <p class="error text-red-500">{{ $message }}</p>
                @enderror
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
