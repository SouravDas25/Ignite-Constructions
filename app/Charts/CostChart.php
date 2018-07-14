<?php

namespace App\Charts;

use App\Purchase;
use App\SiteTransfer;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class CostChart extends Chart
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
        $date = \Carbon\Carbon::now();
        $months = [];
        $purchases = [];
        $trasnfers = [];

        for($i = 0;$i< 12 ;$i++){
            $amount = Purchase::getAmountSpentOnMonth($date->format('m'),$date->format('Y'));
            $tamount = SiteTransfer::getAmountTransferedOnMonth($date->format('m'),$date->format('Y'));
            array_push($months,$date->format('F'));
            array_push($purchases,$amount);
            array_push($trasnfers,$tamount);
            $date->subMonth();
        }
        $months = array_reverse($months);
        $purchases = array_reverse($purchases);
        $trasnfers = array_reverse($trasnfers);
        $this->labels($months);

        $this->dataset('Purchases', 'line', $purchases)
            ->options(['borderColor' => 'rgba(54, 162, 235, 1)','backgroundColor' => 'rgba(54, 162, 235, 0.2)']);
        $this->dataset('Transfers', 'line', $trasnfers)
            ->options(['borderColor' => 'rgba(255, 206, 86, 1)','backgroundColor'=> 'rgba(255, 99, 132, 0.2)']);

    }
}
