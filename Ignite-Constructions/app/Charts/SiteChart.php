<?php

namespace App\Charts;

use App\Site;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}

class SiteChart extends Chart
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
        $payments = [];
        $label = [];
        $sites = Site::all();
        $count = $sites->count();
        foreach ($sites as $site) {
            array_push($data, $site->totalCostOfGoods());
            array_push($payments, $site->totalPaymentAmount());
            array_push($label, strlen($site->name) > 17 ? initials($site->name) : $site->name);
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
        $this->dataset('Total Cost', 'bar', $data)
            ->color($colors)->backgroundColor($bgColor);
        $this->dataset('Total Payments', 'bar', $payments)
            ->color($colors)->backgroundColor($bgColor);
        $this->labels($label);
        //$this->minimalist(true);
    }

}
