@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>Oops! Something went wrong on our end.</p>
        <p>Please try refreshing the page, or come back later if the problem persists.</p>
        <p>If you need immediate assistance, feel free to <a href="{{ url('/contact') }}" style="color: #3490dc;">contact us</a>.</p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
