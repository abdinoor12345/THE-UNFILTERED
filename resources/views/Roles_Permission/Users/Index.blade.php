@extends('layouts.admin')

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
        <a class="float-end font-bold text-xl  rounded shadow-md  " href="{{route('roles.index')}}">Roles</a>

        <a class="float-start font-bold text-xl text-zinc-100  bg-slate-400 p-2 rounded" href="{{route('users.create')}}">Add user</a>
        <h1 class="text-lg font-bold text-center">users</h1>
        
        <div class="bg-light mt-4">
             <table class="min-w-full border border-spacing-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border text-left">Name</th>
                        <th class="px-4 py-2 border text-left"> Email</th>

                        <th class="px-4 py-2 border text-left">Action</th>
                        <th class="py-2 px-4 border-b">Roles</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>

                            <td class="px-4 py-2 border"><span class="flex flex-grow gap-4">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline bg-zinc-200 rounded px-1 ">
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-2 py-2 ring-1 rounded-md mx-2">Delete</button>
                                </form>
                                </span>
                                <a href="{{url('users/'.$user->id.'/assign-roles')}}" class="underline text-purple-800">Add/Edit role</a></td>
                            </td>
                            <td class="py-2 px-4 border-b">
                                 @if($user->roles->isNotEmpty())
                                    @foreach($user->roles as $role)
                                        <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-800 font-mono">No roles assigned</span>
                                @endif
                            </td>
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
