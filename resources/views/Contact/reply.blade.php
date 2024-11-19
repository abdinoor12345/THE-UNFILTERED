@extends('layouts.admin')

@section('title', 'Reply to Contact')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h2 class="text-xl font-semibold mb-4">Reply to {{ $contact->name }}</h2>
        
        <form action="{{ route('contacts.sendReply', $contact->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium">Message</label>
                <textarea id="message" name="message" rows="4" class="w-full border border-gray-300 rounded mt-1" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Send Reply</button>
        </form>
    </div>
@endsection
