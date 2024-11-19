@extends('layouts.website')

@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))

@section('additional_message')
    <div style="text-align: center; margin-top: 20px; color: #555;">
        <p>This resource requires payment to access. Please complete your payment to proceed.</p>
        <p>If you have already made a payment and believe this is an error, please contact support.</p>
        <p><a href="{{ url('/payment') }}" style="color: #3490dc;">Go to Payment Page</a></p>
        <p><a href="{{ url('/') }}" style="color: #3490dc;">Return to Home</a></p>
    </div>
@endsection
