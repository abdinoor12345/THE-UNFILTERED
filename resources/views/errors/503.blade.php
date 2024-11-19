@extends('layouts.website')

@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>Our service is currently down for maintenance. We are working hard to bring it back online as soon as possible.</p>
        <p>Thank you for your patience and understanding!</p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
