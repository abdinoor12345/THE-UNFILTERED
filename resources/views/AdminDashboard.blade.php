 <!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')
 <style>
    .number-container {
    position: relative; 
    display: inline-block;  
}

.total-posts {
    font-size: 3rem;  
    font-family: serif;  
    text-align: center;  
    text-decoration: underline;  
    margin-left: 1.5rem;  
    color: green;
}

.plus {
    position: absolute;  
    top: -0.5rem;  
    right: -0.75rem;  
    font-size: 1.5rem;  
    color: blue;  
}

 </style>
@section('content')
    <div class="border-b border-gray-300 mb-6 pb-4">
        
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4">
               <h5 class="font-extrabold text-lg  text-purple-800 mb-2">  Users and Posts statistics 👥  📝</h5>
            <span class="flex flex-row gap-2 mt-6 justify-between"> 
                 <p class="text-blue-600 mb-4 text-lg"> Number of authors:  
                            <span class="text-black badge bg-success">      {{$authorcount}}</span>
               </p>
               <p class="text-blue-600 mb-4 text-lg "> Total Users:          <span class="text-black badge bg-success">      {{$users}}</span>
               </p></span>
               <span class="flex flex-grow gap-2"><p class="text-primary font-bold">New Posts This Week <span class="badge bg-success">{{$totalLastWeekPosts}}</span></p><p class="text-primary font-bold"> Active Users Today<span class="badge bg-secondary">30</span></p></span>
                 
             </span>
             @if($topAuthorThisMonth)
             <p class="text-black font-bold ">Top Author This Month: <span class="text-primary italic">{{ $topAuthorThisMonth->name }}</span> </p>
             <p class="text-black font-bold">Total Posts:<span class="badge bg-secondary m-2 p-2WW"> {{ $topAuthorThisMonth->total_posts }}</span></p>
         @else
             <p class="italic">No posts from authors this month.</p>
         @endif
         
                <p class="text-xl font-bold text-green-900">Active Users Today:</p>
               <div class="number-container">
                <span class="total-posts"> 50</span>
                <p class="plus">+</p>
            </div>   
             </div>         
                    
    </div>   <div class="bg-white rounded-lg shadow overflow-hidden">
             <div class="p-4">
                <h5 class="font-bold text-lg mb-2 text-purple-800 "> Content Management 📂</h5>
                <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg font-extrabold"> Recently Edited Contents:     
                         <span class="text-black">   
                    @if($lastEditedTableName)
    <p class="text-muted">Last edited table: {{ $lastEditedTableName }}</p>
    <p class="text-secondary">Last edited at: {{ \Carbon\Carbon::parse($lastEditedTime)->diffForHumans() }}</p>
@else
    <p>No recent edits in the past two days.</p>
@endif

                </span>
               </p>
               <p class="text-blue-600 mb-4 text-lg font-extrabold">  Popular tags: </p>
                   <span class="flex flex-row gap-2">                  <p class="text-yellow-600 font-bold font-mono underline"><a  href ="/" class="text-yellow-600">{{$mostViewedTable->table_name}}</a> </p>  with 
                    <span class="bg-success badge">{{$mostViewedTable->views_sum}} <p class="text-black">views</p></span> 
                </span> 
            
               </p></span>
               <h1 class="text-lg font-bold text-blue-800 text-center mt-6  ">Number of Posts for the Past 1 month</h1>
               <div class="number-container">
                <span class="total-posts">{{$totalPosts}}</span>
                <p class="plus">+</p>
            </div>
             </span>    
                     
    </div> 
    </div>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4">
           <h5 class="font-semibold text-lg mb-2 text-purple-800"> Engagement Metrics 📊</h5>
           <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg font-extrabold">  Average Time on Site: {{ $averageTimeFormatted }}</p>
           </p>
          <p class="text-blue-600 mb-4 text-lg font-extrabold">  Page Views:          <span class="text-white badge bg-success p-2">      {{$totalMonthlyViews}}</span>
          </p></span> <div class="flex flex-grow gap-2 font-bold text-green-900"> <p>
            @if($mostViewedPost)
    <p class="text-xs">Most Viewed Post This Month:</p>
    <p class="text-xs text-red-500">Title: {{ Str::limit($mostViewedPost->title,15) }}</p>
    <p>Views: <span class="badge bg-warning text-white">{{ $mostViewedPost->views }}</span></p>
@else
    <p>No views recorded for posts this month.</p>
@endif
          </p>
         <p class="text-xs">Average Views per Post: <span class="bg-secondary badge m-2 p-2">{{ number_format($averageViews, 2) }}</p>
    </div>
          <h1 class="text-lg font-bold text-purple-500 text-center mt-6 underline"> User Demographics</h1>
          <div class="flex flex-row gap-2 m-4  font-extrabold ">
            <p>Africa</p><p>   Europe</p><p>Asia</p><p> America</p> 

          </div>
        </span>    
                
</div> 
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4">
       <h5 class="font-semibold text-lg mb-2">SITE PERFORMANCE 📈</h5>
       <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg">  Uptime Percentage:          <span class="text-black">      {{$authorcount}}</span>
      </p>
      <p class="text-blue-600 mb-4 text-lg"> Page Load Time          <span class="text-black">      {{$users}}</span>
      </p></span>
      <h1 class="text-lg font-bold text-blue-800 text-center mt-6"> Server Health Status</h1>
       
    </span>    
            
</div> 
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4">
       <h5 class="font-semibold text-lg mb-2"> REVENUE METRICS 💰</h5>
       <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg "> Ad Impressions:    
              <span class="text-black bg-warning badge"> 200     </span>
      </p>
      <p class="text-blue-600 mb-4 text-lg"> Monthly Revenue:          <span class="text-black bg-warning badge"> $3000</span>
      </p></span>
      <h1 class="text-lg font-bold text-blue-800 text-center mt-6">Revenue Growth Rate</h1>
     
    </span>    
            
</div> 
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4">
       <h5 class="font-semibold text-lg mb-2"> NOTIFICATION 🔔</h5>
       <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg">  New User Registrations:          <span class="text-black">      {{$authorcount}}</span>
      </p>
      <p class="text-blue-600 mb-4 text-lg">  Content Approvals Needed:          <span class="text-black">      {{$users}}</span>
      </p></span>
      <h1 class="text-lg font-bold text-blue-800 text-center mt-6"> System Alerts or Errors</h1>
      
    </span>    
            
</div> 
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4">
       <h5 class="font-semibold text-lg mb-2">   Calendar and Scheduling 📅</h5>
       <span class="flex flex-row gap-2 mt-6 justify-between">  <p class="text-blue-600 mb-4 text-lg">  Upcoming Events:          <span class="text-black">      {{$authorcount}}</span>
      </p>
      <p class="text-blue-600 mb-4 text-lg"> Scheduled Maintenance:          <span class="text-black">      {{$users}}</span>
      </p></span>
      <h1 class="text-lg font-bold text-blue-800 text-center mt-6" >Upcoming Events</h1>
      
    </span>    
            
</div> 
</div>
 </div>
@endsection
