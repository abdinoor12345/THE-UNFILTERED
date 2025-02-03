<?php

namespace App\Http\Controllers;
use App\Charts\TopArticlesChart;
use App\Charts\ViewsPieChart;
use App\Models\Basketball;
use App\Models\Cricket;
use App\Models\Hockey;
use App\Models\Sponsered;
use App\Models\Story;
use App\Models\Technology;
use App\Models\Top_Story;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Charts\SampleChart;

use App\Models\Business;
use App\Models\Like;
use App\Models\Link;
use App\Models\Opinion;
use App\Models\Sport;
use App\Models\User;
use App\Models\Video;
use App\Models\UserSession;

class Admincontroller extends Controller
{
    public function admin(){
         // Calculate the average session duration grouped by date
         $sessionData = UserSession::selectRaw('DATE(start_time) as date, AVG(TIMESTAMPDIFF(SECOND, start_time, end_time)) as avg_duration')
         ->groupBy('date')
         ->orderBy('date', 'asc')
         ->get();
 
     // Calculate the total session time in seconds
     $totalSessionTime = UserSession::selectRaw('SUM(TIMESTAMPDIFF(SECOND, start_time, end_time)) as total_time')
         ->value('total_time');
 
     // Format total time as HH:MM:SS
     $hours = floor($totalSessionTime / 3600);
     $minutes = floor(($totalSessionTime % 3600) / 60);
     $seconds = $totalSessionTime % 60;
     $formattedTotalTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
 
     // Prepare data for the chart
     $dates = $sessionData->pluck('date')->map(function ($date) {
         return Carbon::parse($date)->format('Y-m-d');
     });
 
     $avgDurations = $sessionData->pluck('avg_duration');
 
     $session = new SampleChart;
     $session->labels($dates);
     $session->dataset('Average Session Duration', 'line', $avgDurations)
         ->backgroundColor('rgba(75, 192, 192, 0.2)')
         ->color('rgba(75, 192, 192, 1)')
         ->fill(false)
         ->lineTension(0.1);
 
        $topStoriesArticles = Story::orderBy('views', 'desc')->take(5)->get();
        $topSportsArticles = Sport::orderBy('views', 'desc')->take(5)->get();
        $topOpinionArticles = Opinion::orderBy('views', 'desc')->take(5)->get();
        $topTrendingArticles = Trending::orderBy('views', 'desc')->take(5)->get();
        $topTechnologyArticles = Technology::orderBy('views', 'desc')->take(5)->get();
        $topBusinessArticles = Business::orderBy('views', 'desc')->take(5)->get();
        $topTopStoryArticles = Top_Story::orderBy('views', 'desc')->take(5)->get();

        // Combine articles and sort by views
        $allArticles = $topSportsArticles->merge($topStoriesArticles)
            ->merge($topOpinionArticles)
            ->merge($topTrendingArticles)
            ->merge($topTechnologyArticles)
            ->merge($topBusinessArticles)
            ->merge($topTopStoryArticles)
            ->sortByDesc('views')
            ->take(10); // Top 10 articles

        $articleTitles = $allArticles->pluck('title');
        $articleViews = $allArticles->pluck('views');

        // Creating the chart
        $article = new TopArticlesChart();
        $article->labels($articleTitles);
        $article->dataset('Top Performing Articles in unfiltered', 'bar', $articleViews)
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ]);
        ////////////////////////////////////
        $monthlyViews = [];
        $totalViews = 0;

        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('F');
            $views = $this->getTotalViewsForMonth($date->month, $date->year);
            $monthlyViews[$monthName] = $views;
            $totalViews += $views;
        }

        $monthlyViews = array_reverse($monthlyViews); // to show in ascending order

        // Creating the pie chart
        $pie = new ViewsPieChart;
        $pie->labels(array_keys($monthlyViews));
        $pie->dataset('Total Views', 'pie', array_values($monthlyViews))
            ->options([
                'backgroundColor' => [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(201, 203, 207, 0.6)',
                    'rgba(231, 209, 207, 0.6)',

                ]
            ]);

        $sportViews = Sport::sum('views');
        $opinionViews = Opinion::sum('views');
        $trendingViews = Trending::sum('views');
        $technologyViews = Technology::sum('views');
        $businessViews = Business::sum('views');
        $topStoryViews = Top_Story::sum('views');
        $stories=Story::sum('views');
        $sponereds=Sponsered::sum('views');
        $hockeys=Hockey::sum('views');
        $crickets=Cricket::sum('views');
        $basketballs=Basketball::sum('views');
 
$totals=$sponereds+ $stories+$topStoryViews+ $hockeys+$crickets+$basketballs+
$businessViews+$technologyViews+$trendingViews+$opinionViews+ $sportViews;

        $data = [
            'labels' => ['Sports', 'Opinions', 'Trendings', 'Technologies', 'Business', 'Top Stories','stories','sponsereds'],
            'values' => [$sportViews, $opinionViews, $trendingViews, $technologyViews, $businessViews, $topStoryViews, $stories, $sponereds]
        ];
        $chart = new  SampleChart;

         $chart->customizeChart($data);
         
    $lastMonth = Carbon::now()->subMonth();
    $query = DB::table('trendings')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')->unionAll(
        DB::table('top__stories')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('opinions')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('businesses')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('sports')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('hockeys')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('basketballs')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('crickets')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('soccers')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('stories')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('shops')->where('created_at', '>=', $lastMonth)->selectRaw('COUNT(*) as count')
    );

    $totalPosts = DB::table(DB::raw("({$query->toSql()}) as counts"))
        ->mergeBindings($query)  
        ->sum('count');
    // last week
    $lastweek = Carbon::now()->subWeek();
    $query = DB::table('trendings')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')->unionAll(
        DB::table('top__stories')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('opinions')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('businesses')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('sports')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('hockeys')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('basketballs')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('crickets')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('soccers')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('stories')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    )->unionAll(
        DB::table('shops')->where('created_at', '>=', $lastweek)->selectRaw('COUNT(*) as count')
    );
    
    $totalLastWeekPosts = DB::table(DB::raw("({$query->toSql()}) as counts"))
    ->mergeBindings($query)  
    ->sum('count');
    
    $authorcount = User::role('An author')->count();
    $users = User::count();
    //its for total views past 6 months
    $lastMonth = Carbon::now()->subMonths(6);
    
    // Query to sum views from all relevant tables for the past month
    $query = DB::table('trendings')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')->unionAll(
        DB::table('top__stories')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('opinions')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('businesses')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('sports')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('hockeys')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('basketballs')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('crickets')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('soccers')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    )->unionAll(
        DB::table('stories')->where('created_at', '>=', $lastMonth)->selectRaw('SUM(views) as views_sum')
    );
    // Sum the views from the union query results
    $totalMonthlyViews = DB::table(DB::raw("({$query->toSql()}) as views_counts"))
        ->mergeBindings($query)
        ->sum('views_sum');
        $lastMonth = Carbon::now()->subMonth();

        // Query to get the sum of views for each table with the table name for the past month
        $query = DB::table('trendings')
            ->where('created_at', '>=', $lastMonth)
            ->selectRaw("'trendings' as table_name, SUM(views) as views_sum")
            ->unionAll(
                DB::table('top__stories')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'top__stories' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('opinions')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'opinions' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('businesses')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'businesses' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('sports')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'sports' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('hockeys')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'hockeys' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('basketballs')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'basketballs' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('crickets')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'crickets' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('soccers')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'soccers' as table_name, SUM(views) as views_sum")
            )
            ->unionAll(
                DB::table('stories')
                    ->where('created_at', '>=', $lastMonth)
                    ->selectRaw("'stories' as table_name, SUM(views) as views_sum")
            );
     $mostViewedTable = DB::table(DB::raw("({$query->toSql()}) as views_counts"))
        ->mergeBindings($query)
        ->orderByDesc('views_sum')
        ->first();
        $recentlyEditedTimeframe = Carbon::now()->subDays(2);
    
        // Union query to fetch recently edited records across multiple tables
        $query = DB::table('trendings')
            ->where('updated_at', '>=', $recentlyEditedTimeframe)
            ->select('updated_at', DB::raw("'trendings' as table_name"))
            ->unionAll(
                DB::table('top__stories')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'top__stories' as table_name"))
            )->unionAll(
                DB::table('opinions')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'opinions' as table_name"))
            )->unionAll(
                DB::table('businesses')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'businesses' as table_name"))
            )->unionAll(
                DB::table('sports')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'sports' as table_name"))
            )->unionAll(
                DB::table('hockeys')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'hockeys' as table_name"))
            )->unionAll(
                DB::table('basketballs')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'basketballs' as table_name"))
            )->unionAll(
                DB::table('crickets')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'crickets' as table_name"))
            )->unionAll(
                DB::table('soccers')
                    ->where('updated_at', '>=', $recentlyEditedTimeframe)
                    ->select('updated_at', DB::raw("'soccers' as table_name"))
            );
        
        // Execute the union query and get only the most recent record
        $lastEditedContent = DB::table(DB::raw("({$query->toSql()}) as recent_edits"))
            ->mergeBindings($query)
            ->orderBy('updated_at', 'desc')
            ->first();
        
        // Check if there's any recent edit
        if ($lastEditedContent) {
            $lastEditedTableName = $lastEditedContent->table_name;
            $lastEditedTime = $lastEditedContent->updated_at;
        } else {
            $lastEditedTableName = null;
            $lastEditedTime = null;
        }
         
      // Define the start of the current month
    $startOfMonth = Carbon::now()->startOfMonth();
    
    // Union query to count posts by authors with the "An author" role across multiple tables
    $topAuthorThisMonthQuery = DB::table('trendings')
        ->select('user_id', DB::raw('COUNT(*) as post_count'))
        ->where('created_at', '>=', $startOfMonth)
        ->whereIn('user_id', function($query) {
            $query->select('model_id')
                  ->from('model_has_roles')
                  ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                  ->where('roles.name', 'An author');
        })
        ->groupBy('user_id')
        ->unionAll(
            DB::table('top__stories')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('opinions')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('businesses')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('sports')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('hockeys')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('basketballs')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('crickets')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )->unionAll(
            DB::table('technologies')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        )
        ->unionAll(
            DB::table('soccers')
                ->select('user_id', DB::raw('COUNT(*) as post_count'))
                ->where('created_at', '>=', $startOfMonth)
                ->whereIn('user_id', function($query) {
                    $query->select('model_id')
                          ->from('model_has_roles')
                          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                          ->where('roles.name', 'An author');
                })
                ->groupBy('user_id')
        );
    
    // Execute the union query to find the top author
    $topAuthorThisMonth = DB::table(DB::raw("({$topAuthorThisMonthQuery->toSql()}) as combined"))
        ->mergeBindings($topAuthorThisMonthQuery)
        ->select('user_id', DB::raw('SUM(post_count) as total_posts'))
        ->groupBy('user_id')
        ->orderBy('total_posts', 'desc')
        ->first();
    
    // Fetch the user details for the top author, if any
    $topAuthorThisMonth = $topAuthorThisMonth ? User::find($topAuthorThisMonth->user_id)->setAttribute('total_posts', $topAuthorThisMonth->total_posts) : null;
    
    $mostViewedPostQuery = DB::table('trendings')
    ->select('title', 'views', DB::raw("'trendings' as table_name"), 'created_at')
    ->where('created_at', '>=', $startOfMonth)
    ->unionAll(
        DB::table('top__stories')
            ->select('title', 'views', DB::raw("'top__stories' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )
    ->unionAll(
        DB::table('opinions')
            ->select('title', 'views', DB::raw("'opinions' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('businesses')
            ->select('title', 'views', DB::raw("'businesses' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('technologies')
            ->select('title', 'views', DB::raw("'technologys' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('sports')
            ->select('title', 'views', DB::raw("'sports' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('crickets')
            ->select('title', 'views', DB::raw("'crickets' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('basketballs')
            ->select('title', 'views', DB::raw("'basketballs' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('hockeys')
            ->select('title', 'views', DB::raw("'hockeys' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )->unionAll(
        DB::table('soccers')
            ->select('title', 'views', DB::raw("'soccers' as table_name"), 'created_at')
            ->where('created_at', '>=', $startOfMonth)
    )
     ->orderByDesc('views')
    ->first();

$mostViewedPost = $mostViewedPostQuery;
// Average Views per Post This Month
$averageViewsQuery = DB::table('trendings')
    ->where('created_at', '>=', $startOfMonth)
    ->select(DB::raw('AVG(views) as avg_views'))
    ->unionAll(
        DB::table('top__stories')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    )
    ->unionAll(
        DB::table('opinions')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('technologies')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('businesses')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('sports')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('soccers')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('hockeys')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    ) ->unionAll(
        DB::table('crickets')
            ->where('created_at', '>=', $startOfMonth)
            ->select(DB::raw('AVG(views) as avg_views'))
    )
     ->get();

$averageViews = $averageViewsQuery->avg('avg_views');
$averageSessionTime = DB::table('user_sessions')
->whereNotNull('end_time')
->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, start_time, end_time)) as avg_time'))
->value('avg_time');

$averageTimeFormatted = $averageSessionTime ? gmdate("H:i:s", $averageSessionTime) : '00:00:00';
        return view('AdminDashboard',compact('authorcount','users','totalPosts',
        'totalLastWeekPosts','totalMonthlyViews','mostViewedTable','lastEditedTableName', 'lastEditedTime',
    'topAuthorThisMonth',
'mostViewedPost','averageViews','session', 'formattedTotalTime','averageTimeFormatted','article','chart','totals','pie','totalViews','monthlyViews'));  
    }
    private function getTotalViewsForMonth($month, $year)
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();
        $storyViews = Story::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');

        $sportViews = Sport::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');
        $opinionViews = Opinion::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');
        $trendingViews = Trending::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');
        $technologyViews = Technology::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');
        $businessViews = Business::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');
        $topStoryViews = Top_Story::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('views');

        return $sportViews + $opinionViews + $storyViews+$trendingViews + $technologyViews + $businessViews + $topStoryViews;
    }
 }
