<?php

namespace App\Charts;

use App\Good;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class GoodsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->initData();
    }

    public function initData()
    {
        $data = [];
        $label = [];
        $goods = Good::all();
        $count = $goods->count();
        foreach ($goods as $good){
            array_push($data,$good->totalQuantity());
            array_push($label,$good->name);
        }
        $colors = ['rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];
        $bgColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];
        $count = $count/6;
        for($i=0;$i<$count;$i++){
            $colors += $colors;
            $bgColor += $bgColor;
        }
        $this->dataset('Quantity', 'bar', $data)
            ->color($colors)->backgroundColor($bgColor);
        $this->labels($label);
    }
}
