@extends('layouts.website')

@section('title', 'Advertise with Us - The Unfiltered, Global News Agency')

@section('meta')
    <meta name="description" content="Advertise with The Unfiltered, Global News Agency. Reach a global audience with our advertising options.">
    <meta name="keywords" content="advertise, global news, sponsorship, media marketing, banner ads">
@endsection
<style>
    body{
        overflow-x:hidden;
    }
</style>
@section('content')
<div class="container mx-auto px-4 mt-14 py-12 bg-white rounded shadow-lg">
    <h1 class="text-4xl font-bold text-center text-primary mb-6">Advertise with Us</h1>
    <p class="text-lg text-center text-gray-700 mb-8 font-semibold">Expand your reach with tailored advertising solutions designed to connect you with a global audience.</p>

    <section class="bg-gray-100 p-6 rounded-lg my-8">
        <h2 class="text-3xl font-bold text-primary mb-4 text-center">Why Advertise with Us?</h2>
        <p class="text-lg text-gray-700 text-center mb-6">Our platform reaches a diverse and engaged audience that values unbiased news coverage. Partnering with us enhances your brand's visibility and credibility.</p>
        <div class="flex justify-around">
            <div class="flex flex-col items-center">
                <!-- Audience Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a4 4 0 11-8 0 4 4 0 018 0zm0 5a5 5 0 00-5 5v2h10v-2a5 5 0 00-5-5zm10 5h-1m1 0h1m-2-2a2 2 0 012-2m-4 2a2 2 0 012 2m-1-7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <p class="text-lg font-semibold text-gray-800">Large Audience</p>
            </div>
            <div class="flex flex-col items-center">
                <!-- Customizable Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m1-10.5A9 9 0 1121 12H3a9 9 0 019-9zm-9 9h.01M12 12h.01M3.05 11.05a7 7 0 0110 0m8.05 1A7 7 0 0112 20.9" />
                </svg>
                <p class="text-lg font-semibold text-gray-800">Customizable Packages</p>
            </div>
            <div class="flex flex-col items-center">
                <!-- Support Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7H7v6h6V7zm-1-4a1 1 0 012 0v3h3a1 1 0 010 2h-3v6h3a1 1 0 010 2h-3v3a1 1 0 11-2 0v-3H7a1 1 0 010-2h5V8H7a1 1 0 010-2h5V4a1 1 0 011-1z" />
                </svg>
                <p class="text-lg font-semibold text-gray-800">Dedicated Support</p>
            </div>
        </div>
    </section>

    <section class="my-12">
        <h2 class="text-3xl font-bold text-primary mb-4 text-center">Our Advertising Options</h2>
        <ul class="text-xl font-semibold text-gray-700 list-disc list-inside mx-auto w-2/3">
            <li>Banner Ads - High-visibility placements to capture attention</li>
            <li>Sponsored Content - Reach readers with articles featuring your brand</li>
            <li>Newsletter Sponsorship - Deliver your message directly to inboxes</li>
        </ul>
    </section>

    <section class="my-12 text-center">
        <h2 class="text-3xl font-bold text-primary mb-4">Get in Touch</h2>
        <p class="text-lg text-gray-700 mb-4 font-medium">Interested in advertising? Contact us today!</p>
        <div class="text-lg">
            <p>Email: <a href="mailto:advertising@theunfiltered.com" class="text-blue-500 underline">advertising@theunfiltered.com</a></p>
            <p>Phone: <a href="tel:+1234567890" class="text-blue-500 underline">+254 782857893</a></p>
            <p>Address: 1234 News St, Nairobi City, Kenya</p>
        </div>
    </section>

    <section class="my-12 p-8 bg-primary text-white rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-center">Start Your Campaign</h2>
        <p class="text-lg text-center mb-6">Ready to grow your brand? Let’s work together to make an impact!</p>
        <div class="flex justify-center">
            <a href="mailto:mohamedabdinoor701@gmail.com" class="bg-white text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition duration-300">Contact Us</a>
        </div>
    </section>
</div>
@endsection
