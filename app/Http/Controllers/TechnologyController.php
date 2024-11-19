<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\ShareFacade as Share;

class TechnologyController extends Controller
{
    public function create(){
        return view('The_UNFILTERED.Technology.Create');
    }
    public function store(Request $request)
{
    $user = Auth::user();

     $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'image_url' => 'nullable|string|max:255',  
        'important_link' => 'nullable|string|max:255',  
        'content' => 'required|string|max:3000',
        'link1'=>'nullable|url|max:255',
        'link2'=>'nullable|url|max:255',
        'link3'=>'nullable|url|max:255',
        'link_text1'=>'nullable|url|max:500',
        'link_text2'=>'nullable|url|max:500',
        'link_text3'=>'nullable|url|max:500',

    ]);

     $validatedData['user_id'] = $user->id;

     Technology::create($validatedData);

     return redirect()->back()->with('message', 'News submitted successfully!');
}
public function index(){      
    $popularPosts = Technology::orderBy('views', 'desc')->take(3)->get();   
    $shareButtons = Share::page(
        'https://unfiltered.com/technologies',    
        'THE UNFILTERED'    
    )
    ->facebook()
    ->twitter()
    ->linkedin()
    ->telegram()
    ->whatsapp();   

    $latest= Technology::orderBy('created_at','desc')->first();
    $news =  Technology::orderBy('created_at', 'desc')->get();
    return view('The_UNFILTERED.Technology.Index', ['news' => $news,'latest'=>$latest,'popularPosts'=> $popularPosts,'shareButtons'=>$shareButtons]);

}
public function show($slug){
    $shareButtons = Share::page(
        'https://unfiltered.com/technologies',    
        'THE UNFILTERED'    
    )
    ->facebook()
    ->twitter()
    ->linkedin()
    ->telegram()
    ->whatsapp();  
       $links = Link::all();
    $post = Technology::where('slug', $slug)->firstOrFail();
    $post->increment('views');
    $relatedPosts = $post->getRelatedPosts();

    return view('The_UNFILTERED.Technology.Show',['post'=>$post,'links'=>$links,'relatedPosts'=>$relatedPosts,'shareButtons'=>$shareButtons],);
}
public function edit_technology($id){
    $technology=Technology::findOrFail($id);
    return view('The_UNFILTERED.Technology.Edit',compact('technology'));
}
public function update(Request $request, $id){
    $validatedData=$request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'content' => 'required',
        'image_url' => 'nullable|url',
        'important_link' => 'nullable|url',
    ]);
    $technology= Technology::find($id);
    $technology->update($validatedData);
    return redirect()->route('technology.index')->with('successs','Page Updated Successfully');
}
public function destroy($id)
{
    $Technology =  Technology::find($id);

    if ($Technology) {
        $Technology->delete();
        return redirect()->route('technology.index')->with('successs','Page Deleted Successfully');
    }
}
}
