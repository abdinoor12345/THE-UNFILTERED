@extends('layouts.website')
@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>You do not have permission to access this page.</p>
        <p>If you believe this is an error, please contact support for assistance.</p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
