@extends('layouts.admin')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-2 border-lime-600">
        <main class="container mx-auto bg-transparent mt-8">
            <table class="w-full text-left border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-gray-300 font-bold text-blue-700">Word</th>
                        <th class="p-4 border-b border-gray-300 font-bold text-blue-700">URL</th>
                        <th class="p-4 border-b border-gray-300 font-bold text-blue-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Link as $item)
                        <tr>
                            <td class="p-4 border-b border-gray-200 text-green-600">{{ $item->word }}</td>
                            <td class="p-4 border-b border-gray-200">{{ $item->url }}</td>
                            <td class="p-4 border-b border-gray-200">
                                <a href="{{ route('edit.links', $item->id) }}" class="bg-green-400 p-2 rounded-lg ring-1">Edit</a>
                                
                                <form action="{{ route('links.destroy', $item->id) }}" method="post" class="inline" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 p-2 rounded-lg ring-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this news story?');
        }
    </script>
@endsection
