@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>It seems that you've made too many requests in a short period of time. Please try again later.</p>
        <p>If you believe this is an error, please contact support for assistance.</p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
