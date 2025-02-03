<!DOCTYPE html> @vite('resources/css/app.css')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
 <head>
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   @vite(['resources/js/app.js', 'resources/js/hljs.js', 'resources/css/highlight-custom.css','resources/sass/app.scss'])
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Unfiltered, Global News Agency')</title>
    <link rel="icon" href="{{ asset('images/THE UNFILTERED.png') }}" type="image/x-icon">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
   
    <head>  <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       <!-- Include Font Awesome (CDN link) -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">

    </head>


    <style>
        h1{  font-family: "Sofia", sans-serif;
    }
        body{
            overflow-x:hidden;
        }
    .social-btn-sp #social-links {

margin: 0 auto;

max-width: 500px;

}

.social-btn-sp #social-links ul li {

display: inline-block;

}          

.social-btn-sp #social-links ul li a {

padding: 5px;

border: 1px solid #ccc;

margin: 1px;

font-size: 20px;

}

table #social-links{

display: inline-table;

}

table #social-links ul li{

display: inline;

}

table #social-links ul li a{

padding: 5px;

border: 1px solid #ccc;

margin: 1px;

font-size: 10px;

background: #e3e3ea;

}


    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow fixed top-0 left-0 right-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                          <a href="/">  <img src="{{ asset('Images/THE UNFILTERED.png') }}" alt="The Unfiltered Logo" class="w-16 h-16 mr-4"></a>
                            {{-- <a href="{{ url('/') }}" class="text-lg text-green-900 font-bold italic pr-4">THE UNFILTERED</a> --}}
                        </div>
                    </div>
                    <!-- Links -->
                    <div class="hidden md:flex space-x-6 mt-4">
                        <a href="{{ route('news.top_story') }}" class="  font-bold text-xl text-black hover:text-gray-900">Top Stories</a>
                        <a href="{{ route('opinions') }}" class="font-bold text-xl text-black hover:text-gray-900">Politics</a>
                        <a href="{{ route('sports.get') }}" class="font-bold text-xl text-black hover:text-gray-900">Sports</a>
                         <a href="{{ route('technology.index') }}" class="font-bold text-xl text-black hover:text-gray-900">Technology</a>
                        <a href="{{ route('business') }}" class="font-bold text-xl text-black hover:text-gray-900">Business</a>
                        <a href="{{ route('video') }}" class="font-bold text-xl text-black hover:text-gray-900">Videos</a>
                        <a href="{{ route('stories.index') }}" class="font-bold text-xl text-black hover:text-gray-900">Stories</a>

                        <form action="{{ route('search.results') }}" method="GET" class="mb-8 rounded-xl shadow">
                            <input type="text" name="query" id="search-query" class="border p-2 w-full mb-10 rounded shadow" placeholder="Search..." autocomplete="off">
                        </form>

                     </div>
                </div>
                <div class="hidden md:flex items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-gray-900 pl-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-primary 500 font-bold text-lg hover:text-gray-900 pr-2">Sign Up</a>
                    @endauth
                </div>
                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex md:hidden ">
                    <button id="menu-toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" id="menu-open-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg class="h-6 w-6 hidden" id="menu-close-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden h-full font-extrabold" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-2 ">
                <a href="{{ route('news.top_story') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Top Stories</a>
                <a href="{{ route('opinions') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Politics</a>
                <a href="{{ route('sports.get') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Sports</a>
                <span class="flex flex-col gap-2">
                    <a href="{{ route('business') }}" class="font-bold text-xl text-black hover:text-gray-900">Business</a>
                    <a href="{{ route('technology.index') }}" class="font-bold text-xl text-black hover:text-gray-900">Technology</a>
    
                </span>
 
                 <a href="{{ route('video') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Videos</a>
                 @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900 block">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-900 block">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 block">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-900 block">Register</a>
                @endauth
                <form action="{{ route('search.results') }}" method="GET" class="">
                    <input type="text" name="query" id="search-query" class="border p-2 w-full mb-10 rounded-xl shadow text-black border-blue-600  " placeholder="Search..." autocomplete="off">
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-20">
        <h1 class="text-2xl text-center text-pink-400 font-light font-serif">@yield('title')</h1>
        <div class="flex flex-row gap-4 mt-4 shadow-lg bg-white rounded-lg justify-between mx-10 px-20 py-2">
            <p class="text-xl font-bold text-blue-500 underline"><a class="underline" href="shops">The Storefront</a></p>
            <p class="text-xl font-bold text-blue-500"><a class="underline" href="stories">Story Spotlight</a></p>
            <p class="text-xl font-bold text-blue-500"><a href="/ebooks">E-books</a></p>
        </div>
        <div class="bg-blue-200"id="live-search-results"></div>
        <div class="bg-blue-200"id="live-search-result"></div>

        
        @yield('content')
    </main>
    <div class="bg-light p-8 rounded-lg shadow-md text-center mx-2 ">
       <span class="flex flex-grow gap-8 justify-center">
 
         <button class="btn btn-success font-extrabold   text-white py-2 px-4 rounded-full hover:bg-blue-600 transition duration-200">
        <a class="text-white" href="/subcribe"> Subcribe </a>    
        </button> <button    class="btn btn-success font-extrabold  bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-600 transition duration-200">
           <a href="/advertise-with-us" class="text-white "> Advertise With Us</a>
                </button>
       </span>
    </div>
               <!-- Footer -->
<footer class=" text-white py-10 mb-0  bg-emerald-900 mt-2 p-4">
    <div class="max-w-7xl mx-auto text-center">
        <!-- Social Media and Quick Links Side by Side on Large Screens -->
        <div class="mb-6 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-2">
            <!-- Stay Connected Section -->
            <div>
                <h4 class="text-lg font-bold">Stay Connected</h4>
                <p class="text-sm">Follow us on our social media channels for the latest news updates.</p>
                <div class="flex flex-wrap justify-center space-x-4 mt-2">
                    <a href="#" class="hover:text-gray-400"><i class="fab fa-facebook text-blue-400 text-lg"></i></a>
                    <a href="#" class="hover:text-gray-400"><i class="fab fa-twitter text-blue-500 text-lg"></i></a>
                    <a href="#" class="hover:text-gray-400"><i class="fab fa-instagram text-lg text-blue-500"></i></a>
                    <a href="#" class="hover:text-gray-400"><i class="fab fa-linkedin text-lg text-blue-400"></i></a>
                </div>
            </div>
             <!-- Quick Links Section -->
            <div>
                <h4 class="text-lg font-bold">Quick Links</h4>
                <div class="flex flex-wrap justify-center space-x-6 mt-2">
                    <a href="{{ route('home') }}" class="hover:text-gray-400">Home</a>
                    <a href="{{ route('home') }}" class="hover:text-gray-400">News</a>
                    <a href="{{ route('about_us') }}" class="hover:text-gray-400">About Us</a>
                    <a href="{{ route('contact') }}" class="hover:text-gray-400">Contact</a>
                </div>
            </div>
        </div>
<hr/>
        <!-- Footer description -->
        <div class="mb-6 sm:flex sm:flex-col sm:items-center">
            {{-- <img src="{{ asset('Images/THE UNFILTERED.png') }}" alt="The Unfiltered Logo" class="w-20 h-20 mr-4 rounded-full sm:mr-0"> --}}
            <p class="text-sm sm:text-center">Your source for the latest and most reliable news articles.</p>
        </div>
        

        <!-- Copyright Section -->
        <div>
            &copy; {{ date('Y') }} The Unfiltered. All rights reserved.
        </div>
    </div>
</footer>

    
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpenIcon = document.getElementById('menu-open-icon');
        const menuCloseIcon = document.getElementById('menu-close-icon');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');
            menuCloseIcon.classList.toggle('hidden');
        });
        function likePost(type, postId) {
        fetch(`/posts/${type}/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(`like-count-${type}-${postId}`).textContent = data.likesCount;
        })
        .catch(error => console.error('Error:', error));
    }

         document.getElementById('search-query').addEventListener('input', function() {
            const query = this.value;

            if (query.length > 0) {
                fetch(`{{ route('search.ajax') }}?query=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('live-search-results').innerHTML = data;
                    });
            } else {
                document.getElementById('live-search-results').innerHTML = '';
            }
        });
    </script>    
</body>
</html>
