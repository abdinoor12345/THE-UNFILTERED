<?php

namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\Soccer;
use App\Models\Basketball;
use App\Models\Cricket;
use App\Models\Sport;
use App\Models\Hockey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportsController extends Controller
{
    public function soccer(){
        $latest= Soccer::orderBy('created_at','desc')->first();
        $news = Soccer::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED.Sports.Soccer',['latest'=>$latest,'news'=>$news]);
    }

    public function Hockey(){
        $latest= Hockey::orderBy('created_at','desc')->first();
        $news =  Hockey::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED.Sports.Hockey',['latest'=>$latest,'news'=>$news]);
    }
    public function Rugby(){
        $latest=  Basketball::orderBy('created_at','desc')->first();
        $news =  Basketball::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED.Sports.Rugb',['latest'=>$latest,'news'=>$news]);
    }
    public function Cricket(){
        $latest= Cricket::orderBy('created_at','desc')->first();
        $news =  Cricket::orderBy('created_at', 'desc')->get();
        return view('The_UNFILTERED.Sports.Cricket',['latest'=>$latest,'news'=>$news]);
    }
    public function create_news() {
        return view('The_UNFILTERED/Sports/Create');  
    }
    
    public function store_news(Request $request) {
        $user=Auth::user();
         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string|max:3000',
            'image_url' => 'nullable|url|max:255',
            'category' => 'required|string|max:255',
            'important_link' => 'nullable|url|max:255',
            'link1'=>'nullable|url|max:255',
            'link2'=>'nullable|url|max:255',
            'link3'=>'nullable|url|max:255',
            'link_text1'=>'nullable|url|max:500',
            'link_text2'=>'nullable|url|max:500',
            'link_text3'=>'nullable|url|max:500',

        ]);
        $validatedData['user_id']=$user->id;
    switch($validatedData['category']){
        case 'soccer':
            Soccer::create($validatedData);
            break;
            case'cricket':
                Cricket::create($validatedData);
                break;
                case'basketball':
                    Basketball::create($validatedData);
                    break;
                    case'hockey':
                        Hockey::create($validatedData);
                        default:
                        Sport::create($validatedData);

    }
     
         return redirect()->back()->with('message', 'News submitted successfully!');
    }
    
     public function get_news() {
        $latest = Cache::remember('latest_sport_news', 60, function () {
            return Sport::orderBy('created_at', 'desc')->first();
        });
    
        $news = Cache::remember('all_sport_news', 60, function () {
            return Sport::orderBy('created_at', 'desc')->limit(10)->get();
        });
        $popularPosts = Sport::orderBy('views', 'desc')->take(3)->get();   

      return view('The_UNFILTERED/Sports/Index', ['news' => $news,'latest'=>$latest,'popularPosts'=>$popularPosts]);
  }
  public function show($slug)
  {       $links = Link::all();

       $post =Sport::where('slug', $slug)->firstOrFail();
 $post->increment('views');
 $relatedPosts = $post->getRelatedPosts();

       return view('The_UNFILTERED/Sports/Show', compact('post','links','relatedPosts'));
  }
    public function edit_news($id)
  {
      $SportSport =Sport::find($id);
      return view('The_UNFILTERED/Sports/Edit_Sport', compact('SportSport'));
  }
    
  public function update_news(Request $request, $id)
  {
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
  
       $SportSport =Sport::find(id: $id);
  
       $SportSport->update($validatedData);  
  
       return redirect()->route('sports.get', $SportSport->id)->with('success', 'News updated successfully!');
  }
  public function destroy_news($id)
  {
      $SportSport =Sport::find($id);

      if ($SportSport) {
          $SportSport->delete();
          return redirect()->route('viewlandingpage')->with('success', 'News deleted successfully!');
      }

      return redirect()->route('viewlandingpage')->with('error', 'News not found!');
  } 
  public function Soccer_show($slug)
  {
       $post =Soccer::where('slug', $slug)->firstOrFail();
  $links=Link::all();
      return view('The_UNFILTERED/Sports/Soccer_Show', compact('post','links'));
  }  public function Cricket_show($slug)
  {$links=Link::all();
       $post =Cricket::where('slug', $slug)->firstOrFail();
  
      return view('The_UNFILTERED/Sports/Cricket_show', compact('post','links'));
  }
  public function Basketball_show($slug)
  {$links=Link::all();
       $post = Basketball::where('slug', $slug)->firstOrFail();
  
      return view('The_UNFILTERED/Sports/BasketShow', compact('post','links'));
  }
  public function   hockey_show($slug)
  {$links=Link::all();
       $post = Hockey::where('slug', $slug)->firstOrFail();
  
      return view('The_UNFILTERED/Sports/HockeyShow', compact('post','links'));
  }
       
 }
