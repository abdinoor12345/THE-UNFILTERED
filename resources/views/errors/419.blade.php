@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>Your session has expired. Please refresh the page and try again.</p>
        <p>If you were in the middle of submitting a form, please fill it out again.</p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
