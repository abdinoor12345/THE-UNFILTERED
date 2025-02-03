<?php
namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ViewsPieChart extends Chart
{
    /**
     * Initializes the chart.
     */
    public function __construct()
    {
        parent::__construct();

        // Set default type to 'pie'
        $this->type('bar');
        
        // Optional: Set default options
        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
        ]);
    }
}

