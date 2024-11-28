<x-layout>
    <div class="container mx-auto px-4 py-8">

        <div class="card bg-white shadow-md rounded-lg overflow-hidden">
            <div class=" flex justify-between card-header bg-gray-800 text-white p-4 text-xl">
                <span class="rounded-lg uppercase text-4l">Crud System</span>
                <a href="{{route('user.create')}}" class="btn text-slate-400 bg-white rounded-lg p-2">add new</a>
               
            </div>
            @if (Session::has('suceess'))
            <span class=" alert text-suceess">{{Session::get('suceess')}}</span>
            @endif
            @if (Session::has('fail'))
            <span class="alert text-danger">{{Session::get('fail')}}</span>
            @endif
            <div class="card-body p-6">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b text-left">S/N</th>
                            <th class="px-4 py-2 border-b text-left">Full Name</th>
                            <th class="px-4 py-2 border-b text-left">Email</th>
                            
                            <th class="px-4 py-2 border-b text-left">Registration Date</th>
                            <th class="px-4 py-2 border-b text-left">Last Update</th>
                            <th class="px-4 py-2 border-b text-left" colspan="2">manage</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if (count($all_user)>0)
                       @foreach ($all_user as $item)
                       <tr>
                        <td class="p-2">{{$loop->iteration}}</td>
                        <td class="p-2">{{$item->username}}</td>
                        <td class="p-2">{{$item->email}}</td>
                        <td class="p-2">{{$item->created_at}}</td>
                        <td class="p-2">{{$item->updated_at}}</td>
                        <td class="p-2">
                            <a href="{{ route('editUserForm', $item->id) }}" class="btn text-slate-200 bg-green-500 hover:bg-green-400 capitalize rounded-sm p-2">Edit</a>
                        </td>
                        
                        <td class="p-2">
                            <!-- Form to handle the delete action -->
                            <form action="{{ route('deleteUser', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                <button type="submit" class="btn text-slate-200 bg-red-500 hover:bg-red-400 capitalize rounded-sm p-2">Delete</button>
                            </form>
                        </td>
                        
                        
                        
                        
                       
                        
                       </tr>
                           
                       @endforeach
                           
                       @else
                           <tr>
                            <td colspan="7" class=" capitalize">no user found</td>
                           </tr>
                       @endif
                        <!-- Additional rows can go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
