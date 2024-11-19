@extends('layouts.website')

@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>You are not authorized to access this page. Please check your credentials.</p>
        <p>If you believe this is a mistake, please log in again or contact support for assistance.</p>
        <p><a href="{{ route('login') }}" style="color: #3490dc;">Login</a></p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
