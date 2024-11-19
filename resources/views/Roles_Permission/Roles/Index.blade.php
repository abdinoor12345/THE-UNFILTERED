@extends('layouts.admin')

@section('title', 'THE UNFILTERED, Top Stories, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection
<style>
    .top-end-element{
        top:80px;
        position: absolute;
        right: 10%;
        padding: 10px;
        color: darkblue;
        font-size:20px;
        background-color: darkmagenta
    }
</style>

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <a class="float-start font-bold text-xl text-blue-600 bg-slate-400 inline-block p-2    rounded-md " href="{{route('roles.create')}}">Add Roles</a>
        <a class="float-start font-bold text-xl mx-2 text-blue-600 bg-slate-900 inline-block p-2    rounded-md " href="{{route('users.index')}}">Users</a>

        <h1 class="text-lg font-bold text-center">Roles</h1>
        <p class="top-end-element"><a href="permissions" class=" py-2 px-2 ">Permissions</a></p>

        <div class="bg-light mt-4">
            <table class="min-w-full border border-spacing-4">
                <thead>
                    <tr>
      <th class="px-4 py-2 border text-left">Name</th>
     <th class="px-4 py-2 border text-left">Action</th>
     <th class="px-4 py-2 border text-left">Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td class="px-4 py-2 border">{{ $role->name }}</td> 
                            <td class="px-4 py-2 border"><span class="flex flex-grow gap-4">
                                <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-500 hover:underline bg-slate-300 rounded-md px-2 py-4 mx-2">
                                    Edit Roles
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-2 py-2 ring-1 rounded-md mx-2">Delete</button>
                                </form>
                                
                            </span>
                            <a href="{{url('roles/'.$role->id.'/give_permissions')}}" class="underline text-purple-800">Add/Edit Permissions</a></td>
                            <td class="py-2 px-4 border-b">
                                <!-- Loop through roles and display them -->
                                @if($role->permissions->isNotEmpty())
                                    @foreach($role->permissions as $permission)
                                        <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded">{{ $permission->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-800 font-mono">No roles assigned</span>
                                @endif
                            </td> </tr>
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
