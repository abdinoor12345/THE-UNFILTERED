<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function create(){
        return view('The_UNFILTERED.Business.Create');
    }
    public function store(Request $request){
        $user=Auth::user();
$validatedData=$request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string|max:700',
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
$validatedData['user_id']=$user->id;
Business::create($validatedData);
return redirect()->back()->with('success', 'News submitted successfully!');}
public function index(){
    $popularPosts = Business::orderBy('views', 'desc')->take(3)->get();   

    $latest=Business::orderBy('created_at','desc')->first();
    $news = Business::orderBy('created_at', 'desc')->get();
    return view('The_UNFILTERED.Business.Index',['latest'=>$latest,'news'=>$news,'popularPosts'=>$popularPosts]);

}
public function show($slug){
    $links=Link::all();
    $post=Business::where('slug',$slug)->firstOrFail();
    $post->increment('views');
    return view('The_UNFILTERED.Business.Show',compact('post','links'));
}
   public function edit($id) {
    $business=Business::findOrFail($id);
    return view('The_UNFILTERED.Business.Edit',compact('business'));

   }
   public function update(Request $request, $id){
    $validatedData=$request->validate([
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
    $business=Business::find($id);
    $business->update($validatedData);
    return redirect()->route('business', $business->id)->with('success', 'News updated successfully!');
}
public function destroy($id){
    $business=Business::find($id);
    $business->delete();
    return redirect()->back();
}
 }
