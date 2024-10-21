<?php

namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Trending;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Http\Requests\NewsUpdateRequest;
class The_UnfilteredController extends Controller
{
    
     public function Sports(){
        
          
         return view('THE_UNFILTERED.Sports',   );
     } 
     public function create_news() {
        return view('ArticleWriter/Trending');  
    }
    
    public function store_news(Request $request) {
        $user = Auth::user();
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string|max:3000',
            'image_url' => 'nullable|url|max:255',
            'link1' => 'nullable|url|max:255',
            'link2' => 'nullable|url|max:255',
            'link3' => 'nullable|url|max:255',
            'link_text1' => 'nullable|string|max:500',
            'link_text2' => 'nullable|string|max:500',
            'link_text3' => 'nullable|string|max:500',
        ]);
    
        $validatedData['user_id'] = $user->id;
        Trending::create($validatedData);
    
        return redirect()->back()->with('message', 'News submitted successfully!');
    }
    
    public function get_news() {
         $latest=Trending::orderBy('created_at','desc')->first();
       $news = Trending::orderBy('created_at', 'desc')->take(10)->get();
       $popularPosts = Trending::orderBy('views', 'desc')->take(3)->get();   
      return view('welcome', ['news' => $news,'latest'=>$latest,'popularPosts'=>$popularPosts]);
  }
  public function show($slug)
  {
      // Find the trending post by slug
      $post = Trending::where('slug', $slug)->firstOrFail();
      $links = Link::all();
      $post->increment('views');
      $relatedPosts = $post->getRelatedPosts();
       return view('THE_UNFILTERED/Show_News', compact('post','links', 'relatedPosts'));
  }
    public function edit_news($id)
  {
      $trending = Trending::find($id);
      return view('THE_UNFILTERED/Edit_News', compact('trending'));
  }
  
  public function update_news(Request $request, $id)
  {
      // Validate the request data
      $validatedData = $request->validate([
          'title' => 'required|max:255',
          'description' => 'required',
          'content' => 'required',
          'image_url' => 'nullable|url',
          'important_link' => 'nullable|url',
          'link1'=>'nullable|url|max:255',
          'link2'=>'nullable|url|max:255',
          'link3'=>'nullable|url|max:255',
          'link_text1'=>'nullable|url|max:500',
          'link_text2'=>'nullable|url|max:500',
          'link_text3'=>'nullable|url|max:500',

      ]);
  
       $trending = Trending::find(id: $id);
  
       $trending->update($validatedData);  
  
       return redirect()->route('news.edit', $trending->id)->with('success', 'News updated successfully!');
  }
  public function destroy_news($id)
  {
      $Trending = Trending::find($id);

      if ($Trending) {
          $Trending->delete();
          return redirect()->route('viewlandingpage')->with('success', 'News deleted successfully!');
      }

      return redirect()->route('viewlandingpage')->with('error', 'News not found!');
  } 
  public function video(){
    $categories = [
        ['name' => 'Breaking News', 'slug' => '/BreakingNews', 'icon' => '📰'],
        ['name' => 'Interviews', 'slug' => '/Interviews', 'icon' => '🎙️'],
        ['name' => 'Special Reports', 'slug' => '/SpecialReports', 'icon' => '📊'],
        ['name' => 'Trending Now', 'slug' => '/TrendingNow', 'icon' => '🔥'],
        ['name' => 'Livestream', 'slug' => '/Livestream', 'icon' => '📺'],
    ];

    // Sample videos
    $videos = [
        ['title' => 'Al Jazeera News', 'url' => 'https://www.youtube.com/embed/XWq5kBlakcQ'],
        ['title' => 'BBC World News', 'url' => 'https://youtu.be/P6wEIPvV4Oc?si=KPcjQ-CvXxdniKG9'],
        ['title' => 'NBC News', 'url' => 'https://www.youtube.com/embed/Eg3r1MxsL60'],
        ['title' => 'TRT WORLD', 'url' => 'https://www.youtube.com/embed/Eg3r1MxsL60'],
    ];
    $video = Video::all();
 
    // Page meta and content
    $pageTitle = 'Latest News and Highlights';
    $metaDescription = 'Watch the latest videos on breaking news, interviews, and trending reports from reliable sources.';
    $metaKeywords = 'videos, interviews, news, highlights, latest news, global news, trending';
    $headerText = 'Watch our curated selection of videos and interviews from trusted global sources.';


    return view('Videos.Video',compact('categories', 'videos','video', 'pageTitle', 'metaDescription', 'metaKeywords', 'headerText'));
  }
public function BreakingNews(){
    return view('Videos.BreakingNews');
}
public function Interviews(){
    $videoData = json_decode(file_get_contents(storage_path('videos.json')), true);

    return view('Videos.Interviews',compact('videoData'));
}
public function Livestream(){
    return view('Videos.Livestream');
}
public function SpecialReports(){
    return view('Videos.SpeacialReports');
}
public function TrendingNow(){
    return view('Videos.TrendingNow');
}
 
public function like(Trending $post)
{
    $user = auth()->user();

    // Check if the user has already liked the post
    if ($post->likes()->where('user_id', $user->id)->exists()) {
        return response()->json(['success' => false, 'message' => 'You already liked this post']);
    }

    // Otherwise, add the like
    $post->likes()->create([
        'user_id' => $user->id
    ]);

    // Increment the likes count
    $post->increment('likes');

    return response()->json(['success' => true, 'likes' => $post->likes]);
}

      }  