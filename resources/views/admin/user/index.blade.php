<x-layout>
    <div class="container mx-auto px-4 py-8">

        <div class="card bg-white shadow-md rounded-lg overflow-hidden">
            <div class=" flex justify-between card-header bg-gray-800 text-white p-4 text-xl">
                Crud System
                <a href="{{route('user.create')}}" class="btn text-slate-400 bg-white rounded-lg p-2">add new</a>
               
            </div>
            @if (Session::has('suceess'))
            <span class="text-danger">{{Session::get('suceess')}}</span>
                
            @endif
            <div class="card-body p-6">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b text-left">S/N</th>
                            <th class="px-4 py-2 border-b text-left">Full Name</th>
                            <th class="px-4 py-2 border-b text-left">Email</th>
                            <th class="px-4 py-2 border-b text-left">Phone</th>
                            <th class="px-4 py-2 border-b text-left">Registration Date</th>
                            <th class="px-4 py-2 border-b text-left">Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample rows -->
                        <tr>
                            <td class="px-4 py-2 border-b">1</td>
                            <td class="px-4 py-2 border-b">John Doe</td>
                            <td class="px-4 py-2 border-b">john@example.com</td>
                            <td class="px-4 py-2 border-b">(123) 456-7890</td>
                            <td class="px-4 py-2 border-b">2024-01-01</td>
                            <td class="px-4 py-2 border-b">2024-02-01</td>
                        </tr>
                        <!-- Additional rows can go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
