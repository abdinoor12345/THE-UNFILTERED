@extends('layouts.admin')

@section('title', 'THE UNFILTERED, Top Stories, Trending')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events, T">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <h1 class="text-lg text-blue-800 text-center font-mono font-extrabold">Assign permissions  To Role</h1>
        <span class="text-xl font-bold text-blue-500 text-center"> {{$role->name}}</span>
        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-lime-400 shadow-lg rounded-md p-2 m-2">
                @foreach ($permissions as $permission)
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <input type="checkbox" id="name" name="permissions[]" value="{{ $permission->name }}" class="block w-full p-4 " {{in_array($permission->id, $rolePermission)?'checked':''}}>
                       <span class="flex flex-grow gap-2 text-sm font-bold text-blue-500 ">Role:{{ $permission->name }}</span>  
                    </label>
                @endforeach
            </div>
            <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
        </form>
        
          
    </main>
</div>
@endsection
