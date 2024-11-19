<!-- resources/views/partials/sidebar.blade.php -->
<aside id="sidebar" class="bg-black w-full md:w-64 min-h-screen px-4 py-8 hidden md:block scroll-y-fixed">
    <h5 class="text-primary  text-xl font-semibold mb-6 text-center"> <a href="/admin/news">The_Unfiltered</a></h5>
    <ul class="space-y-4 font-bold">
        <li><a href= "{{ url('/') }}" class="text-white no-underline font-bold hover:text-white">Dashboard</a></li>
        <li><a href="{{url('/trendings')}}" class="text-white hover:text-white no-underline">Add Trending</a></li>
        <li><a href="{{url('/top_stories/create')}}" class="text-white hover:text-white no-underline">Add_TopStory</a></li>
        <li><a href="{{route('opinions.create')}}" class="text-white hover:text-white no-underline">Politics</a></li>
        <li><a href="{{url('create/sports')}}" class="text-white hover:text-white no-underline">Sports</a></li>
        <li><a href="{{url('technology/create')}}" class="text-white hover:text-white no-underline">Technology</a></li>
        <li><a href="{{url('/create/business')}}" class="text-white hover:text-white no-underline">Business</a></li>
        <li><a href="{{url('/links/create')}}" class="text-white hover:text-white no-underline"> Add Links</a></li>

        <li><a href="{{url('/users')}}" class="text-white hover:text-white no-underline">Manage Users</a></li>
        <li><a href="{{url('/viewlandingpage')}}" class="text-white hover:text-white no-underline">Manage  News</a></li>
         <li><a href="{{url('/create/business')}}" class="text-white hover:text-white no-underline ring-2 badge bg-warning">Manage  News</a></li>


        <li><a href="#" class="text-white hover:text-white no-underline" >Profile</a></li>
        <li><a href="#" class="text-white hover:text-white no-underline">Logout</a></li>
    </ul>
</aside>
