<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public static function statusID($status)
    {
        $k = Status::all();
        //dd($k);
        foreach ($k as $i) {
            //echo strtolower($i->name) ;
            $perc = 0;
            similar_text(strtolower($i->details), strtolower($status), $perc);
            if ($perc > 70) {
                return $i->id;
            }
        }
        return null;
    }

    public static function PENDING()
    {
        $id = Status::statusID("PENDING");
        return Status::find($id);
    }

    public static function CONFIRMED()
    {
        $id = Status::statusID("CONFIRMED");
        return Status::find($id);
    }
}
