@extends('layouts.website')

@section('title', 'THE UNFILTERED,  About Us')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection
<style>body{
    overflow-x: hidden;
}</style>
@section('content')<body class="bg-gray-100">
    <header class="  text-white py-6 mt-8">
        <h1 class="text-3xl font-bold text-center text-green-600">About Us</h1>
    </header>

    <main class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-md font-extrabold">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome to Our Blog</h2>
            <p class="text-gray-700">
                At The Unfiltered, we are passionate about bringing you the latest insights, trends, and analysis from the world of politics, business, technology, and sports. Our goal is to provide our readers with accurate, engaging, and informative content that sparks discussion and drives awareness on important issues.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Mission</h2>
            <p class="text-gray-700">
                Our mission is to empower our audience by providing in-depth articles and expert opinions that cover various topics. We strive to be a reliable source of information that helps our readers stay informed and make well-rounded decisions in their lives.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Team</h2>
            <p class="text-gray-700">
                Our team consists of experienced writers, analysts, and editors who are dedicated to delivering high-quality content. With backgrounds in journalism, research, and industry-specific knowledge, we are committed to exploring the nuances of the topics we cover.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">What We Cover</h2>
            <ul class="list-disc list-inside text-gray-700">
                <li class="mb-2">Politics: Analysis of current political events, policies, and trends.</li>
                <li class="mb-2">Business: Insights into market trends, entrepreneurship, and economic news.</li>
                <li class="mb-2">Technology: The latest developments in tech, gadgets, and innovation.</li>
                <li class="mb-2">Sports: Coverage of major sporting events, athlete profiles, and analysis.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Join Us</h2>
            <p class="text-gray-700">
                We invite you to join our community of readers and contributors. Share your thoughts, engage
                 with our content, and stay updated on the latest discussions. Thank you for being a part of <a class ="font-bold no-underline" href="contact">TheUnfiltered!</a> 
            </p>
        </section>
    </main>

    
</body>
@endsection
