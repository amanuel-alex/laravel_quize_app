<x-layout>
    <div class="container mx-auto p-8">
        <!-- Dashboard Header -->
        <div class="mb-6">
            <h1 class="text-4xl font-semibold text-gray-800 capitalize">Welcome, Admin {{ Auth::user()->username }}!</h1>
            <p class="text-lg text-gray-600 mt-2">Manage questions, users, and more from this dashboard.</p>
        </div>
        
        <!-- Action Cards -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Manage Questions Card -->
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                <a href="{{ route('manage.questions') }}" class="block text-xl font-semibold text-gray-100 hover:text-green-500">
                    <i class="bx bx-list-check text-2xl mb-2"></i> Manage Questions
                </a>
            </div>

            <!-- Add Question Card -->
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                <a href="{{ route('store.create') }}" class="block text-xl font-semibold text-gray-100 hover:text-green-500">
                    <i class="bx bx-plus-circle text-2xl mb-2"></i> Add Question
                </a>
            </div>

            <!-- Manage Users Card -->
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                <a href="{{ route('user_detail') }}" class="block text-xl font-semibold text-gray-100 hover:text-green-500">
                    <i class="bx bx-user text-2xl mb-2"></i> Manage Users
                </a>
            </div>
        </div>
        
        <!-- Add Note / Reference Button -->
        <div class="mt-6 flex justify-center">
            <button class="bg-blue-600 text-white rounded-lg px-6 py-3 text-lg hover:bg-blue-700 transition duration-300" 
                    onclick="openAddNoteModal()">
                <i class="bx bx-note text-xl mr-2"></i> Add Note / Reference
            </button>
        </div>

        <!-- Modal for Adding Note (Hidden by default) -->
        <div id="addNoteModal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50 hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Add Note / Reference</h2>
                <textarea class="w-full p-4 border border-gray-300 rounded-lg mb-4" rows="6" placeholder="Write your note or reference here..."></textarea>
                <div class="flex justify-end gap-4">
                    <button class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600" onclick="closeAddNoteModal()">Cancel</button>
                    <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        Save Note
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        // Function to open the "Add Note" modal
        function openAddNoteModal() {
            document.getElementById('addNoteModal').classList.remove('hidden');
        }

        // Function to close the "Add Note" modal
        function closeAddNoteModal() {
            document.getElementById('addNoteModal').classList.add('hidden');
        }
    </script>
</x-layout>
