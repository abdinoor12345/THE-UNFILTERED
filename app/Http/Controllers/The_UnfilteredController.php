<?php

namespace App\Http\Controllers;
use App\Models\Business;
use App\Models\Like;
use App\Models\Link;
use App\Models\Opinion;
use App\Models\Sport;
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
        $shareButtons = Share::page(
            'https://unfiltered.com',    
            'THE UNFILTERED'    
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        $videos=Video::orderBy('created_at','desc')->take(2)->get();

         $latest=Trending::orderBy('created_at','desc')->first();
       $news = Trending::orderBy('created_at', 'desc')->take(10)->get();
       $popularPosts = Trending::orderBy('views', 'desc')->take(3)->get();   
      return view('welcome', ['news' => $news,'latest'=>$latest,'popularPosts'=>$popularPosts,'videos'=>$videos,'shareButtons'=>$shareButtons]);
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
 
 
//  public function admin(){
    
//     $lastMonth = Carbon::now()->subMonth();
//     $query = DB::table('trendings')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')->unionAll(
//         DB::table('top__stories')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('opinions')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('businesses')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('sports')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('hockeys')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('basketballs')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('crickets')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     )->unionAll(
//         DB::table('soccers')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
//     );

// $totalPosts = DB::table(DB::raw("({$query->toSql()}) as counts"))
// ->mergeBindings($query)  
// ->sum('count');
// // last week
// $lastweek = Carbon::now()->subWeek();
// $query = DB::table('trendings')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')->unionAll(
//     DB::table('top__stories')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('opinions')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('businesses')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('sports')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('hockeys')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('basketballs')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('crickets')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// )->unionAll(
//     DB::table('soccers')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
// );

// $totalLastWeekPosts = DB::table(DB::raw("({$query->toSql()}) as counts"))
// ->mergeBindings($query)  
// ->sum('count');

//     $authorcount=User::role('An author')->count();
//     $users=User::count();
//     $lastMonth = Carbon::now()->subMonth();

// // Query to sum views from all relevant tables for the past month
// $query = DB::table('trendings')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')->unionAll(
//     DB::table('top__stories')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('opinions')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('businesses')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('sports')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('hockeys')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('basketballs')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('crickets')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// )->unionAll(
//     DB::table('soccers')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
// );

// // Sum the views from the union query results
// $totalMonthlyViews = DB::table(DB::raw("({$query->toSql()}) as views_counts"))
//     ->mergeBindings($query)
//     ->sum('views_sum');
//     $lastMonth = Carbon::now()->subMonth();

// // Query to get the sum of views for each table with the table name for the past month
// $query = DB::table('trendings')
//     ->where('created_at', '>=', $lastMonth)
//     ->selectRaw("'trendings' as table_name, SUM(views) as views_sum")
//     ->unionAll(
//         DB::table('top__stories')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'top__stories' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('opinions')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'opinions' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('businesses')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'businesses' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('sports')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'sports' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('hockeys')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'hockeys' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('basketballs')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'basketballs' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('crickets')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'crickets' as table_name, SUM(views) as views_sum")
//     )
//     ->unionAll(
//         DB::table('soccers')
//             ->where('created_at', '>=', $lastMonth)
//             ->selectRaw("'soccers' as table_name, SUM(views) as views_sum")
//     );

//  $mostViewedTable = DB::table(DB::raw("({$query->toSql()}) as views_counts"))
//     ->mergeBindings($query)
//     ->orderByDesc('views_sum')
//     ->first();
//     $recentlyEditedTimeframe = Carbon::now()->subDays(2);

//     // Union query to fetch recently edited records across multiple tables
//     $query = DB::table('trendings')
//         ->where('updated_at', '>=', $recentlyEditedTimeframe)
//         ->select('updated_at', DB::raw("'trendings' as table_name"))
//         ->unionAll(
//             DB::table('top__stories')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'top__stories' as table_name"))
//         )->unionAll(
//             DB::table('opinions')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'opinions' as table_name"))
//         )->unionAll(
//             DB::table('businesses')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'businesses' as table_name"))
//         )->unionAll(
//             DB::table('sports')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'sports' as table_name"))
//         )->unionAll(
//             DB::table('hockeys')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'hockeys' as table_name"))
//         )->unionAll(
//             DB::table('basketballs')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'basketballs' as table_name"))
//         )->unionAll(
//             DB::table('crickets')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'crickets' as table_name"))
//         )->unionAll(
//             DB::table('soccers')
//                 ->where('updated_at', '>=', $recentlyEditedTimeframe)
//                 ->select('updated_at', DB::raw("'soccers' as table_name"))
//         );
    
//     // Execute the union query and get only the most recent record
//     $lastEditedContent = DB::table(DB::raw("({$query->toSql()}) as recent_edits"))
//         ->mergeBindings($query)
//         ->orderBy('updated_at', 'desc')
//         ->first();
    
//     // Check if there's any recent edit
//     if ($lastEditedContent) {
//         $lastEditedTableName = $lastEditedContent->table_name;
//         $lastEditedTime = $lastEditedContent->updated_at;
//     } else {
//         $lastEditedTableName = null;
//         $lastEditedTime = null;
//     }
     
//   // Define the start of the current month
// $startOfMonth = Carbon::now()->startOfMonth();

// // Union query to count posts by authors with the "An author" role across multiple tables
// $topAuthorThisMonthQuery = DB::table('trendings')
//     ->select('user_id', DB::raw('COUNT(*) as post_count'))
//     ->where('created_at', '>=', $startOfMonth)
//     ->whereIn('user_id', function($query) {
//         $query->select('model_id')
//               ->from('model_has_roles')
//               ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//               ->where('roles.name', 'An author');
//     })
//     ->groupBy('user_id')
//     ->unionAll(
//         DB::table('top__stories')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('opinions')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('businesses')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('sports')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('hockeys')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('basketballs')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('crickets')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     )
//     ->unionAll(
//         DB::table('soccers')
//             ->select('user_id', DB::raw('COUNT(*) as post_count'))
//             ->where('created_at', '>=', $startOfMonth)
//             ->whereIn('user_id', function($query) {
//                 $query->select('model_id')
//                       ->from('model_has_roles')
//                       ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
//                       ->where('roles.name', 'An author');
//             })
//             ->groupBy('user_id')
//     );

// // Execute the union query to find the top author
// $topAuthorThisMonth = DB::table(DB::raw("({$topAuthorThisMonthQuery->toSql()}) as combined"))
//     ->mergeBindings($topAuthorThisMonthQuery)
//     ->select('user_id', DB::raw('SUM(post_count) as total_posts'))
//     ->groupBy('user_id')
//     ->orderBy('total_posts', 'desc')
//     ->first();

// // Fetch the user details for the top author, if any
// $topAuthorThisMonth = $topAuthorThisMonth ? User::find($topAuthorThisMonth->user_id)->setAttribute('total_posts', $topAuthorThisMonth->total_posts) : null;

 
//     return view('AdminDashboard',compact('authorcount','users','totalPosts',
//     'totalLastWeekPosts','totalMonthlyViews','mostViewedTable','lastEditedTableName', 'lastEditedTime',
// 'topAuthorThisMonth'));
// }
// creating dynamic post
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