<x-layout>
    
    @auth
    <div class="flex items-center justify-center">
      
       <h1 class="text4l">welcome {{auth()->user()->username}}</h1>
    
    </div>
    @endauth
 
    @guest
    <div class="flex items-center justify-center">
      
      <h1 class="text4l text-center">guest user</h1>
    </div>
       
    @endguest
 </x-layout>