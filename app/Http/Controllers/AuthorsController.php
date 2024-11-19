<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Link;
use App\Models\Opinion;
use App\Models\Top_Story;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Trending;
use App\Models\Sport;
use App\Models\Technology;


class AuthorsController extends Controller
{
    public function ViewLandingPage(){
        $news = Trending::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/ViewLandingPage', ['news' => $news]);
  
    }
    public function TopStoriesPage(){
        $Top_Story = Top_Story::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/TopStoriesPage', ['Top_Story' => $Top_Story]);
  
    }
    public function OpinionPage(){
        $opinion= Opinion::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/OpinionPage', ['opinion' => $opinion]);
  
    }
    public function SportPage(){
        $sport= sport::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/SportsView', ['sport' => $sport]);
  
    }
    public function TechnologyPage(){
        $Technology= Technology::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/TechnologysView', ['Technology' => $Technology]);
  
    }
    public function BusinessPage(){
        $business= Business::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/BusinessView', ['business' => $business]);
  
    }
    public function LinkPage(){
        $Link= Link::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/LinksView', ['Link' => $Link]);
  
    }

    public function VideoPage(){
        $video= Video::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED/Authors/Videosview', ['video' => $video]);
  
    }
 }
