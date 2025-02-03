<?php

namespace App\Http\Controllers;
use App\Models\Business;
use App\Models\Ebook;
use App\Models\Like;
use App\Models\Link;
use App\Models\Opinion;
use App\Models\Shop;
use App\Models\Sponsered;
use App\Models\Sport;
use App\Models\Story;
use App\Models\Technology;
use App\Models\Top_Story;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Trending;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Jorenvh\Share\ShareFacade as Share;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\NewsUpdateRequest;
use Illuminate\Support\Facades\Cache;

class The_UnfilteredController extends Controller
{
    public function dashboard(){
        $shareButtons = Share::page(
            'https://unfiltered.com',    
            'THE UNFILTERED'    
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        $politics = Opinion::orderBy('created_at', 'desc')->take(3)->get();
        $business = Business::orderBy('created_at', 'desc')->take(3)->get();
        $technologies = Technology::orderBy('created_at', 'desc')->take(3)->get();
        $sports = Sport::orderBy('created_at', 'desc')->take(3)->get();


        $videos=Video::orderBy('created_at','desc')->take(2)->get();
        $topstories = Top_Story::latest()->skip(1)->paginate(5);
        //  $latest=Trending::orderBy('created_at','desc')->first();
       $news = Trending::orderBy('created_at', 'desc')->take(6)->get();
       $popularPosts = Trending::orderBy('views', 'desc')->take(3)->get();   
        return view('dashboard',compact('news','popularPosts','videos','shareButtons',
        'topstories','politics','business','technologies','sports'));
    }
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
            'heading1'=>'nullable|string|max:500',
            'content1'=>'nullable|string|max:1700'
            
        ]);
    
        $validatedData['user_id'] = $user->id;
        Trending::create($validatedData);
    
        return redirect()->back()->with('message', 'News submitted successfully!');
    }
    
 
    public function get_news() {
        // Caching for share buttons (if the same on every page load)
        $shareButtons = Cache::remember('share_buttons', now()->addMinutes(10), function () {
            return Share::page(
                'https://unfiltered.com',
                'THE UNFILTERED'
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp();
        });
    
        // Caching product data
        $products = Cache::remember('latest_products', now()->addMinutes(10), function () {
            return Shop::orderBy('created_at', 'desc')->take(10)->get();
        });
    
        // Caching video data
        $videos = Cache::remember('latest_videos', now()->addMinutes(10), function () {
            return Video::orderBy('created_at', 'desc')->take(2)->get();
        });
    
        // Caching trending news
        $news = Cache::remember('latest_news', now()->addMinutes(10), function () {
            return Trending::orderBy('created_at', 'desc')->take(10)->get();
        });
    
        // Caching latest trending post
        $latest = Cache::remember('latest_trending', now()->addMinutes(10), function () {
            return Trending::orderBy('created_at', 'desc')->first();
        });
    
        // Caching featured posts
        $featuredPosts = Cache::remember('featured_posts', now()->addMinutes(10), function () {
            return Sponsered::orderBy('created_at', 'desc')->take(10)->get();
        });
    
        // Caching popular posts
        $popularPosts = Cache::remember('popular_posts', now()->addMinutes(10), function () {
            return Trending::orderBy('views', 'desc')->take(3)->get();
        });
    
        // Caching stories
        $stories = Cache::remember('latest_stories', now()->addMinutes(10), function () {
            return Story::orderBy('created_at', 'desc')->take(3)->get();
        });
    
        // Caching ebooks
        $ebooks = Cache::remember('latest_ebooks', now()->addMinutes(10), function () {
            return Ebook::orderBy('created_at', 'desc')->take(3)->get();
        });
    
        // Return the view with cached data
        return view('welcome', [
            'news' => $news,
            'latest' => $latest,
            'popularPosts' => $popularPosts,
            'videos' => $videos,
            'featuredPosts' => $featuredPosts,
            'shareButtons' => $shareButtons,
            'ebooks' => $ebooks,
            'products' => $products,
            'stories' => $stories
        ]);
    }
    
  public function show($slug)
  {
       $post = Trending::where('slug', $slug)->firstOrFail();
      $links = Link::all();
      $post->increment('views');
      $relatedPosts = $post->getRelatedPosts();
      $shareButtons = Share::page(
        'https://unfiltered.com/business',    
        'THE UNFILTERED'    
    )
    ->facebook()
    ->twitter()
    ->linkedin()
    ->telegram()
    ->whatsapp();   
       return view('THE_UNFILTERED/Show_News', compact('post','links', 'relatedPosts','shareButtons'));
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
          'heading1'=>'nullable|string|max:500',
            'content1'=>'nullable|string|max:1700'
          
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
 
 
 
public function like(Request $request, $type, $id)
{
    // Define the model classes for each post type
    $models = [
        'trending' => Trending::class,
        'politics' => Opinion::class,
        'sports' => Sport::class,
        'business' => Business::class,
    ];

     $model = $models[$type] ?? null;
    if (!$model) {
        return response()->json(['error' => 'Invalid type'], 404);
    }

     $post = $model::findOrFail($id);

    // Check if a like already exists by this user for this post
    $like = Like::where('user_id', auth()->id())
                ->where('likeable_type', $model)
                ->where('likeable_id', $post->id)
                ->first();

    // Toggle the like: if no like exists, create one; otherwise, remove it
    if (!$like) {
        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $post->id,
            'likeable_type' => $model,
        ]);
    } else {
        $like->delete(); // Unlike
    }
    $likeCount = $post->likes()->count();

    // Return the updated like count
    return response()->json(['likesCount' => $post->likes()->count()]);
}

}