@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 sm:px-12">
    <h1 class="text-2xl font-semibold mb-6">Send Recommendations</h1>

    <!-- Form to send recommendations -->
    <form action="{{ route('admin.recommendations.send') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="user_id" class="block text-lg font-medium text-gray-700">User</label>
            <select name="user_id" id="user_id" class="form-select mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <!-- Iterate over users to create options -->
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="message" class="block text-lg font-medium text-gray-700">Recommendation Message</label>
            <textarea name="message" id="message" rows="4" class="form-textarea mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('message') }}</textarea>
        </div>

        <!-- Submit button -->
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                Send Recommendation
            </button>
        </div>
    </form>
</div>
@endsection

