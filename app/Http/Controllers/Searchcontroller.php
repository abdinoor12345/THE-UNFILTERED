<?php

namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\Sport;
use App\Models\Opinion;
use App\Models\Trending;
use App\Models\Technology;
use App\Models\Business;
use App\Models\Top_Story;
use Illuminate\Http\Request;

class Searchcontroller extends Controller
{
    public function showResults(Request $request)
    { $links = Link::all();
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

       
        $query = $request->input('query');

$sports = Sport::where('title', 'LIKE', "%{$query}%")
       ->orWhere('description', 'LIKE', "%{$query}%")
       ->get();

$politics = Opinion::where('title', 'LIKE', "%{$query}%")
           ->orWhere('description', 'LIKE', "%{$query}%")
           ->get();

$trendings = Trending::where('title', 'LIKE', "%{$query}%")
             ->orWhere('description', 'LIKE', "%{$query}%")
             ->get();

$technologies = Technology::where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->get();

$businesses = Business::where('title', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->get();

$topStories = Top_Story::where('title', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->get();

return view('search.results', compact(
  'sports', 'links','politics', 'trendings', 'technologies', 'businesses', 'topStories', 'query'
));
}
public function ajaxSearch(Request $request)
{ $links = Link::all();
    $query = $request->input('query');
    $sports = Sport::where('title', 'LIKE', "%{$query}%")
    ->orWhere('description', 'LIKE', "%{$query}%")
    ->get();

$politics = Opinion::where('title', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->get();

$trendings = Trending::where('title', 'LIKE', "%{$query}%")
          ->orWhere('description', 'LIKE', "%{$query}%")
          ->get();

$technologies = Technology::where('title', 'LIKE', "%{$query}%")
               ->orWhere('description', 'LIKE', "%{$query}%")
               ->get();

$businesses = Business::where('title', 'LIKE', "%{$query}%")
           ->orWhere('description', 'LIKE', "%{$query}%")
           ->get();

$topStories = Top_Story::where('title', 'LIKE', "%{$query}%")
           ->orWhere('description', 'LIKE', "%{$query}%")
           ->get();

return view('search.ajax_results', compact(
  'sports', 'politics', 'trendings', 'technologies', 'businesses', 'topStories','links'
));
}
}
