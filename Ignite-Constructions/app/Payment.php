<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Payment extends Model
{
    public function site()
    {
        return $this->belongsTo('App\Site', 'site_id');
    }

    public static function getAmountSpentOnMonth($month,$year)
    {
        $data = DB::select("SELECT SUM(amount) AS AMOUNT , MONTH(created_at) , YEAR(created_at) 
                    FROM `payments`
                    WHERE MONTH(created_at) = $month AND YEAR(created_at) = $year");
        if(count($data) > 0){
            return $data[0]->AMOUNT ;
        }
        return 0;
    }
}
