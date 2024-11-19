<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight text-center">
            {{ __('The Unfiltered') }}
        </h2>
    </x-slot>
<style>body{
    overflow-x: hidden;
}</style>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Share Buttons -->
                         <div class="mt-4 social-btn-sp">
                        {!! $shareButtons !!}</div>
                     <!-- Trending News Section -->
                    <h3 class="text-lg font-bold mt-8 mb-4 text-center text-purple-600 font-serif">Trending News</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        @foreach($news as $item)
                            <li class="bg-white dark:bg-gray-100 p-4 rounded mb-2 shadow text-primary">
                                <a href="{{ route('news.show', $item->slug) }}" class="font-semibold text-gray-900 dark:text-gray-800"><h1 class="text-xl text-primary">{{ $item->title }}</h1>
                                    <p class="mt-3 text-gray-700">{{ Str::limit($item->description, 120) }}</p>
                                    @if($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="mt-4 w-full h-40 object-cover rounded">
                                    @endif</a>
                                <p class="text-gray-600 dark:text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                            </li>
                        @endforeach
                    </div><hr/>
                    <h1 class="text-xl font-bold text-center font-mono text-purple-500">TopStories</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                     @foreach($topstories as $item)
                    <article class="    p-4 bg-slate-100">
                        <a href="{{ route('top_stories.show', $item->slug) }}">
                            <h2 class="text-xl font-bold text-blue-700  ">{{ $item->title }}</h2>
                            <p class="text-gray-900 mt-2 text-xl font-extrabold ">{{ $item->description }}</p>
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                            @endif
                        </a>
                        <div class="flex flex-grow gap-4 item-center  ">    
                            <p class="text-black text-sm">   Posted:{{ $item->created_at->diffForHumans() }}</p>
                                @if($item->user)
               <span class="  text-green-800 text-sm "> Posted by: {{$item->user->name}}</span>@else
               Posted by: <span class="text-black text-sm font-bold">Anonymous</span>
                @endif</div>
                    </article>
                    @endforeach
                </div><hr/>
                <h1 class="text-red-600 font-mono font-bold text-xl text-center">Politics</h1>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($politics as $item)
                        <article class="mb-6 rounded-lg shadow-lg bg-white p-6 hover:bg-gray-50 transition transform hover:-translate-y-1 hover:shadow-2xl duration-300">
                            <a href="{{ route('opinions.show', $item->slug) }}" class="block">
                                <header>
                                    <h2 class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">{{ $item->title }}</h2>
                                    <div class="flex items-center gap-4 mt-2 text-gray-500 text-sm">    
                                        <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                        <span class="text-gray-400 font-bold">
                                            {{ $item->user ? 'Posted by: ' . $item->user->name : 'Posted by: Anonymous' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mt-3 font-semibold">{{ $item->description }}</p>
                                </header>
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                                @endif
                            </a>
                        </article>
                    @endforeach
                </div><hr/>
                <h1 class="text-red-600 font-mono font-bold text-xl text-center italic">Business</h1>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($business as $item)
                        <article class="mb-6 rounded-lg shadow-lg bg-white p-6 hover:bg-gray-50 transition transform hover:-translate-y-1 hover:shadow-2xl duration-300">
                            <a href="{{ route('business.show', $item->slug) }}" class="block">
                                <header>
                                    <h2 class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">{{ $item->title }}</h2>
                                    <div class="flex items-center gap-4 mt-2 text-gray-500 text-sm">    
                                        <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                        <span class="text-gray-400 font-bold">
                                            {{ $item->user ? 'Posted by: ' . $item->user->name : 'Posted by: Anonymous' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mt-3 font-semibold">{{ $item->description }}</p>
                                </header>
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                                @endif
                            </a>
                        </article>
                    @endforeach
                </div><hr/>
                <h1 class="text-red-600  font-bold text-xl text-center font-sans">Technology</h1>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($technologies as $item)
                        <article class="mb-6 rounded-lg shadow-lg bg-white p-6 hover:bg-gray-50 transition transform hover:-translate-y-1 hover:shadow-2xl duration-300">
                            <a href="{{ route('technology.show', $item->slug) }}" class="block">
                                <header>
                                    <h2 class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">{{ $item->title }}</h2>
                                    <div class="flex items-center gap-4 mt-2 text-gray-500 text-sm">    
                                        <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                        <span class="text-gray-400 font-bold">
                                            {{ $item->user ? 'Posted by: ' . $item->user->name : 'Posted by: Anonymous' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mt-3 font-semibold">{{ $item->description }}</p>
                                </header>
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                                @endif
                            </a>
                        </article>
                    @endforeach
                </div><hr/>
                <h1 class="text-red-600  font-bold text-xl text-center font-sans">Sports</h1>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($sports as $item)
                        <article class="mb-6 rounded-lg shadow-lg bg-white p-6 hover:bg-gray-50 transition transform hover:-translate-y-1 hover:shadow-2xl duration-300">
                            <a href="{{ route('sports.show', $item->slug) }}" class="block">
                                <header>
                                    <h2 class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">{{ $item->title }}</h2>
                                    <div class="flex items-center gap-4 mt-2 text-gray-500 text-sm">    
                                        <p>Posted: {{ $item->created_at->diffForHumans() }}</p>
                                        <span class="text-gray-400 font-bold">
                                            {{ $item->user ? 'Posted by: ' . $item->user->name : 'Posted by: Anonymous' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mt-3 font-semibold">{{ $item->description }}</p>
                                </header>
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto mt-4 rounded-lg">
                                @endif
                            </a>
                        </article>
                    @endforeach
                </div><hr/>
                    <!-- Popular Posts Section -->
                    <h3 class="text-lg font-bold mt-8 mb-4 text-center">Popular Posts</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        @foreach($popularPosts as $post)<ol type="A">

                            <li class="bg-white dark:bg-gray-700 p-4 rounded mb-2 shadow text-primary">
                                <a href="{{ route('news.show', $post->slug) }}" class="font-semibold text-blue-700 dark:text-gray-200">{{ $post->title }}</a>
                                <p class="text-yellow-600 dark:text-gray-400">{{ $post->views }} views</p>
                            </li></ol>
                        @endforeach
                    </div>
                </div>
                <h3 class="text-lg font-bold mb-4 text-center">Latest Videos</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($videos as $video)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded shadow">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ $video->title }}</h4>
                            <img src="{{ $video->image }}" alt="{{ $video->title }}" class="w-full h-48 object-cover rounded mb-2">
                            <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen class="w-full h-24"></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white fixed bottom-0 left-0 w-full mt-6 p-4 flex justify-center items-center space-x-4">
        <a href="#" class="text-gray-100 hover:text-white font-bold">Facebook</a>
        <a href="#" class="text-gray-100 hover:text-white font-bold">Twitter</a>
        <a href="#" class="text-gray-100 hover:text-white font-bold">Instagram</a>
        <a href="#" class="text-gray-100 hover:text-white font-bold">LinkedIn</a>
    </footer>
</x-app-layout>
