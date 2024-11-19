@extends('layouts.website')
@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) 
<div id="notfound">
     <div class="bg-red-300 mt-24">
        <div class="text-3xl font-bold text-red-800">
            <h1>404</h1>
        </div>
        <h2 class="text-purple-700 ">We are sorry. But the page you requested was not found</h2>
       <span class="flex flex-row gap-10">
        <a href="/" class="text-primary text-xl">Go Home</a>
        <a href="contact" class="text-blue-600">Contact us</a></span>  
    </div>
</div>
 