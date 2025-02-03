<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Models\Basketball;
use App\Models\Cricket;
use App\Models\Hockey;
use App\Models\Sponsered;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Opinion;
use App\Models\Trending;
use App\Models\Technology;
use App\Models\Business;
use App\Models\Top_Story;
use App\Models\Story;
use App\Models\UserSession;
 use Carbon\Carbon;
class ChartController extends Controller
{
    public function index()
    {
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
         
        return view('charts.index', compact('chart','totals'));
    }
     
    public function sessionDuration()
    {
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
    
        // Pass chart and total time to the view
        return view('charts.session_duration', compact('session', 'formattedTotalTime'));
    }
}    