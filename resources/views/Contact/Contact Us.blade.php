@extends('layouts.website')

@section('title', 'THE UNFILTERED - Contact Us')

@section('meta')
    <meta name="description" content="Contact us at The Unfiltered, Global News Agency. We welcome your feedback and inquiries regarding our news coverage.">
    <meta name="keywords" content="contact, feedback, inquiries, global news">
@endsection

<style>
    body {
        overflow-x: hidden;
    }
</style>

@section('content')
<body class="bg-gray-100">
    <header class="text-white py-6 mt-8">
        <h1 class="text-3xl font-bold text-center text-green-600">Contact Us</h1>
    </header>

    <main class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-md">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Get in Touch</h2>
            <p class="text-gray-700 mb-4">
                We value your feedback and inquiries! Whether you have a question, suggestion, or just want to say hello, we’d love to hear from you.
            </p>
            <p class="text-gray-700">
                You can reach us through the following contact methods:
            </p>
            <ul class="list-disc list-inside text-gray-700 mt-4">
                <li>Email: <a href="mailto:info@theunfiltered.com" class="text-blue-500">info@theunfiltered.com</a></li>
                <li>Phone: <a href="tel:+1234567890" class="text-blue-500">+123 456 7890</a></li>
                <li>Address: 1234 News St, Media City, Country</li>
            </ul>
        </section>

        <section class="mb-8">
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 mt-2">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Form</h2>
            <form method="POST" action="{{route('contact.submit')}}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Your Name">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Your Email">
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-gray-700">Message</label>
                    <textarea id="message" name="message" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Your Message"></textarea>
                </div>

                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Send Message</button>
            </form>
        </section>

        <section>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Follow Us</h2>
            <p class="text-gray-700">
                Stay connected and follow us on our social media channels for the latest updates:
            </p>
            <div class="flex flex-wrap justify-center space-x-4 mt-2">
                <a href="#" class="hover:text-gray-400"><i class="fab fa-facebook text-blue-400 text-lg"></i></a>
                <a href="#" class="hover:text-gray-400"><i class="fab fa-twitter text-blue-500 text-lg"></i></a>
                <a href="#" class="hover:text-gray-400"><i class="fab fa-instagram text-lg text-blue-500"></i></a>
                <a href="#" class="hover:text-gray-400"><i class="fab fa-linkedin text-lg text-blue-400"></i></a>
            </div>
        </section>
    </main>
</body>
@endsection
