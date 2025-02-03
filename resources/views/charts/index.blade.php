<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Views Histogram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.css">
    <style>
        .chart-container {
            width: 80%;
            height: 50vh;
            margin: auto;
            border: 1px solid blanchedalmond;
            padding-bottom: 16px;
        }
        h1{
            text-align: center;
            color:blue;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h1>Database Table Views</h1>
        <p class="text-center text-gray-600 mb-6">An overview of total views across various categories in our database.</p>
        {!! $chart->container() !!}
        <h1><strong> Total Views:</strong>{{$totals}}</h1>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Ensure that Chart.js is loaded before the custom script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    {!! $chart->script() !!}
</body>
</html>
