<!-- resources/views/partials/navbar.blade.php -->
<nav class="bg-white shadow sticky top-0 z-10">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="#" class="text-2xl font-bold text-blue-600">Admin Dashboard</a>
        <div class="flex items-center">
            <button onclick="toggleMenu()" class="md:hidden text-gray-700 hover:text-gray-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="hidden md:flex space-x-4">
                <a href="#" class="text-gray-700 hover:text-gray-500">Profile</a>
                <a href="#" class="text-gray-700 hover:text-gray-500">Logout</a>
            </div>
        </div>
    </div>
</nav>
