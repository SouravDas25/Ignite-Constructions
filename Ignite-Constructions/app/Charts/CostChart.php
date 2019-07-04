<?php

namespace App\Charts;

use App\Payment;
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
        $payments = [];

        for($i = 0;$i< 12 ;$i++){
            $month = $date->format('m');
            $year = $date->format('Y');
            $amount = Purchase::getAmountSpentOnMonth($month,$year);
            $tamount = SiteTransfer::getAmountTransferedOnMonth($month,$year);
            $pamount = Payment::getAmountSpentOnMonth($month,$year);
            array_push($months,$date->format('F'));
            array_push($purchases,$amount);
            array_push($trasnfers,$tamount);
            array_push($payments,$pamount);
            $date->subMonth();
        }
        $months = array_reverse($months);
        $purchases = array_reverse($purchases);
        $trasnfers = array_reverse($trasnfers);
        $payments = array_reverse($payments);
        $this->labels($months);
        $this->options([
            'scales' => [
                'yAxes' => [
                    'label' => 'Amount',
                    [ 'stacked' => false ]
                ]
            ],
        ]);

        $this->dataset('Purchases', 'line', $purchases)
            ->options([
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)'
            ]);
        $this->dataset('Transfers', 'line', $trasnfers)
            ->options([
                'borderColor' => 'rgba(255, 206, 86, 1)',
                'backgroundColor'=> 'rgba(255, 99, 132, 0.2)'
            ]);
        $this->dataset('Payments', 'line', $payments)
            ->options([
                'borderColor' => 'rgba(255, 159, 64, 1)',
                'backgroundColor'=> 'rgba(255, 159, 64, 0.2)'
            ]);

    }
}
