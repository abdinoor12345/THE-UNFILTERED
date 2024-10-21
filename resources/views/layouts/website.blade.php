<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Unfiltered, Global News Agency')</title>
    <link rel="icon" href="{{ asset('images/THE UNFILTERED.png') }}" type="image/x-icon">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        body {
            overflow-x: hidden;
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
                            <img src="{{ asset('Images/THE UNFILTERED.png') }}" alt="The Unfiltered Logo" class="w-16 h-16 mr-4">
                            <a href="{{ url('/') }}" class="text-lg text-green-900 font-bold italic pr-4">THE UNFILTERED</a>
                        </div>
                    </div>
                    <!-- Links -->
                    <div class="hidden md:flex space-x-6 mt-4">
                        <a href="{{ route('news.top_story') }}" class="  font-bold text-xl text-black hover:text-gray-900">Top Stories</a>
                        <a href="{{ route('opinions') }}" class="font-bold text-xl text-black hover:text-gray-900">Opinion</a>
                        <a href="{{ route('sports.get') }}" class="font-bold text-xl text-black hover:text-gray-900">Sports</a>
                         <a href="{{ route('technology.index') }}" class="font-bold text-xl text-black hover:text-gray-900">Technology</a>
                        <a href="{{ route('business') }}" class="font-bold text-xl text-black hover:text-gray-900">Business</a>
                        <a href="{{ route('video') }}" class="font-bold text-xl text-black hover:text-gray-900">Videos</a>


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
                        <a href="{{ route('login') }}" class="text-blue-500 font-bold text-lg hover:text-gray-900 pr-2">Login</a>
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
                <a href="{{ route('opinions') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Opinions</a>
                <a href="{{ route('sports') }}" class="font-bold text-xl text-black hover:text-gray-900 block">Sports</a>
                <a href="{{ route('business') }}" class="font-bold text-xl text-black hover:text-gray-900">Business</a>

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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-6">
        @yield('content')
    </main>

              <!-- Footer -->
<footer class=" text-white py-10 mb-0  bg-emerald-900 mt-2">
    <div class="max-w-7xl mx-auto text-center">
        <!-- Social Media and Quick Links Side by Side on Large Screens -->
        <div class="mb-6 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-2">
            <!-- Stay Connected Section -->
            <div>
                <h4 class="text-lg font-bold">Stay Connected</h4>
                <p class="text-sm">Follow us on our social media channels for the latest news updates.</p>
                <div class="flex flex-wrap justify-center space-x-4 mt-2">
                    <a href="#" class="hover:text-gray-400">Facebook</a>
                    <a href="#" class="hover:text-gray-400">Twitter</a>
                    <a href="#" class="hover:text-gray-400">Instagram</a>
                    <a href="#" class="hover:text-gray-400">LinkedIn</a>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div>
                <h4 class="text-lg font-bold">Quick Links</h4>
                <div class="flex flex-wrap justify-center space-x-6 mt-2">
                    <a href="{{ route('news') }}" class="hover:text-gray-400">Home</a>
                    <a href="{{ route('news') }}" class="hover:text-gray-400">News</a>
                    <a href="{{ route('news') }}" class="hover:text-gray-400">About Us</a>
                    <a href="{{ route('news') }}" class="hover:text-gray-400">Contact</a>
                </div>
            </div>
        </div>

        <!-- Footer description -->
        <div class="mb-6">
            <p class="text-sm">Your source for the latest and most reliable news articles.</p>
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
    </script>
</body>
</html>
