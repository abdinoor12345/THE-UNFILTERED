@extends('layouts.admin')

@section('title', 'Session Duration')

@section('content')
    <div class="chart-container">
        <h1 class="text-2xl font-bold text-center mb-4">Average Session Duration</h1>
        <div style="height: 400px;">
            {!! $session->container() !!}
        </div>
        <h1>Total Time: {{ $formattedTotalTime}}</h1>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    {!! $session->script() !!}
@endsection
