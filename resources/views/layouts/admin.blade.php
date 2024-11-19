<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/THE UNFILTERED.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; 
    overflow-x: hidden;}
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pHoGytZf7RXHURjH0eKk6BX5STQIoJw1b0D2cdvKaRZPEkp0CvvLQ8E/AE7q7yk4" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Layout -->
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Dynamic Content Area -->
        <main class="flex-1 p-6">
            <p class="text-center mt-2 font-bold text-xl text-red-600">
                Welcome to the Admin News Dashboard. Here, you can manage, add, and categorize
                news articles, keeping your content organized and up-to-date.
            </p>
            @yield('content')
        </main>
    </div>
</body>
</html>
