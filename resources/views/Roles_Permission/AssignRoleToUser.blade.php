@extends('layouts.admin')

@section('title', 'Assign Roles to User')

@section('meta')
    <meta name="description" content="Assign roles to users.">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <main class="container mx-auto bg-transparent mt-8">
        <h1 class="text-lg text-blue-800 text-center font-mono font-extrabold">Assign Roles To User</h1>
        <span class="text-xl font-bold text-blue-500 text-center">User: {{$user->name}}</span>
        
        <form action="{{ route('users.updateRoles', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="bg-lime-400 shadow-lg rounded-md p-2 m-2">
                @foreach ($roles as $role)
                    <label for="role_{{ $role->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}" 
                        {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                        <span class="flex flex-grow gap-2 text-sm font-bold text-blue-500">Role: {{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            
            <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
        </form>
    </main>
</div>
@endsection
