 
@if($sports->isEmpty() && $politics->isEmpty() && $trendings->isEmpty() && $technologies->isEmpty() && $businesses->isEmpty() && $topStories->isEmpty())
<p>No live results found.</p>
@else
<div class="container bg-blue-200 text-center">
@if(!$sports->isEmpty())
    <h4>Sports</h4>
    <ul>
        @foreach ($sports as $sport)
            <li>{{ $sport->title }} - {{ $sport->description }}</li>
        @endforeach
    </ul>
@endif

@if(!$politics->isEmpty())
    <h4 class="text-center"> Politics</h4>
    <ul>
        @foreach ($politics as $politic)
            <li>{{ $politic->title }} - {{ $politic->description }}</li>
        @endforeach
    </ul>
@endif

@if(!$trendings->isEmpty())
    <h4>Trendings</h4>
    <ul>
        @foreach ($trendings as $trending)
            <li>{{ $trending->title }} - {{ $trending->description }}</li>
        @endforeach
    </ul>
@endif

@if(!$technologies->isEmpty())
    <h4>Technologies</h4>
    <ul>
        @foreach ($technologies as $technology)
            <li>{{ $technology->title }} - {{ $technology->description }}</li>
        @endforeach
    </ul>
@endif

@if(!$businesses->isEmpty())
    <h4>Businesses</h4>
    <ul>
        @foreach ($businesses as $business)
            <li>{{ $business->title }} - {{ $business->description }}</li>
        @endforeach
    </ul>
@endif

@if(!$topStories->isEmpty())
    <h4 class="text-center text-primary text-xl font-bold">Top Stories</h4>
    <ul>
        @foreach ($topStories as $topStory)
            <li>{{ $topStory->title }} - {{ $topStory->description }}</li>
        @endforeach
    </ul></div>
@endif
@endif
