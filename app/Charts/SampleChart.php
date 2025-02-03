<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function customizeChart($data)
    {
        if (!isset($data['labels']) || !isset($data['values'])) {
            throw new \InvalidArgumentException('The data array must contain "labels" and "values" keys.');
        }
        $this->labels($data['labels']);
        $this->dataset('Total Views', 'bar', $data['values'])
            ->options([
                'backgroundColor' => [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(201, 203, 207, 0.2)',
                    'rgba(201, 103, 267, 0.2)',
                    'rgba(245, 199, 245, 0.4)',

                ],
                'borderColor' => [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(201, 203, 207, 1)',
                    'rgba(211, 200, 207, 1)',
                    'rgba(201, 205, 68, 1)',


                ],
                'borderWidth' => 2
            ]);
    }
}
