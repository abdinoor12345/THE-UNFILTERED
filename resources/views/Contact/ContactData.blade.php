@extends('layouts.admin')

@section('title', 'THE UNFILTERED, GLOBAL NEWS AGENCY')

@section('meta')
    <meta name="description" content="Stay updated with the latest news from The Unfiltered, Global News Agency. We provide unbiased and comprehensive news coverage.">
    <meta name="keywords" content="news, global news, unfiltered news, latest news, current events">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-l-2 border-lime-600">
        <main class="container mx-auto bg-transparent mt-8">
            <table class="w-full text-left border border-collapse table-responsive">
                <thead>
                    <tr>                      
                          <th class="p-4 border-b border-gray-400 font-bold text-primary">ID</th>

                        <th class="p-4 border-b border-gray-400 font-bold text-primary">NAME</th>
                        <th class="p-4 border-b border-gray-400 font-bold text-primary">EMAIL</th>
                        <th class="p-4 border-b border-gray-400 font-bold text-primary">MESSAGE</th>
                        <th class="p-4 border-b border-gray-400 font-bold text-primary  ">REPLY</th>


                    </tr>
                </thead>     <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="p-4 border-b border-gray-900">{{ $contact->id }}</td>
                            <td class="p-4 border-b border-gray-900">{{ $contact->name }}</td>
                            <td class="p-4 border-b border-gray-900">{{ $contact->email }}</td>
                            <td class="p-4 border-b border-gray-900  ">{{ $contact->message }}</td>
                            <td class="p-4 border-b border-gray-900 ">
                                <a href="{{ route('contacts.reply', $contact->id) }}" class="  hover:underline btn btn-primary m-2 text-white">Reply</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </main></div>@endsection