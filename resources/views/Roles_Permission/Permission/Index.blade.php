@extends('layouts.website')

@section('title', 'THE UNFILTERED, Top Stories, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection
<style>
.float-end{
    top:80px;
    right: 0;
    padding: 10px;
    background-color: darkorchid;
    color: white;
}
</style>
 @section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <a class="float-end font-bold text-xl    " href="{{route('roles.index')}}">Roles</a>

        <a class="float-start font-bold text-xl text-green-600  " href="{{route('permissions.create')}}">Add Permission</a>
        <h1 class="text-lg font-bold text-center">permissions</h1>
        
        <div class="bg-light mt-4">
             <table class="min-w-full border border-spacing-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border text-left">Name</th>
                        <th class="px-4 py-2 border text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td class="px-4 py-2 border">{{ $permission->name }}</td>
                            <td class="px-4 py-2 border"><span class="flex flex-grow gap-4">
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="text-white hover:underline bg-slate-400 p-2 m-2 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-2 py-2 ring-1 rounded-md mx-2">Delete</button>
                                </form>
                                </span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
    <script>
        function confirmDelete(){
            return confirm('Are sure You Want to delete this');
        }
    </script>
</div>
@endsection
