@if($shops->isempty())
<p class="text-center text-2xl text-red-500 mt-32">
    No live results found
</p>
@else
<div class="container bg-blue-200 text-center">
    @foreach($shops as $shop)
    <div class="bg-white rounded-lg shadow">
        <h1>{{$hop->name}}</h1>
        <p>{{$shop->description}}</p>
    </div>
    @endif
</div>
@endif