<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">

   <header class="bg-orange-50 shadow-lg">
      <nav class="flex justify-between items-center w-[92%] mx-auto py-4 ">
        {{-- <img src="{{ asset('img/logo4.png') }}" alt="logo" class="w-22 h-10">  --}}
        <h2 class="nav-link text-lg font-semibold">logo</h2>
        <div class="flex items-center gap-4">
          <a href="{{route('home')}}" class="nav-link text-lg font-semibold hover:text-orange-300">Home</a>
          <a href="{{route('about')}}" class="nav-link text-lg font-semibold hover:text-orange-300">About</a>
          <a href="{{route('explore')}}" class="nav-link text-lg font-semibold hover:text-orange-300">Explore</a>
          <a href="{{route('blog')}}" class="nav-link text-lg font-semibold hover:text-orange-300">Blog</a>
          <a href="{{route('support')}}" class="nav-link text-lg font-semibold hover:text-orange-300">Support</a>
         
        </div>
       
        @auth
            <div class="relative grid place-items-center" x-data="{open:false}">
              <button  @click ="open=!open" class="btn "><p class="username hover:text-black text-lg font-medium capitalize  ">{{auth()->user()->username}}</p></button>
              
              {{-- <p class="email">{{auth()->user()->email}}</p> --}}
              <div  x-show ="open" @click.outside="open=false" class="absolute top-11 px-4 py-5  right-0 overflow-hidden rounded-lg bg-slate-200 shadow-lg ">
              <p class="email mb-4 hover:text-slate-400">{{auth()->user()->email}}</p>
              <a href="{{route('dashboard')}}" class="dashboard mb-8 hover:text-slate-400">Dashboard</a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="block mt-4 w-full text-left hover:text-slate-400">Logout</button>
            </form>
            
              </div>
            </div>
        @endauth


       @guest
       <div class="flex items-center gap-6">
        <a href="{{route('login')}}" class="nav-link text-lg font-semibold hover:text-orange-300">Login</a>
        <a href="{{route('register')}}" class="nav-link text-lg font-semibold hover:text-orange-300 rounded">Register</a>
    </div>
       @endguest
      </nav>
   </header>

   <main class="py-8 px-4 mx-auto max-w-screen-lg">
     {{$slot}}
   </main>

   <footer>
     <h1 class="text-4xl ">Footer</h1>
   </footer>

</body>
</html>
