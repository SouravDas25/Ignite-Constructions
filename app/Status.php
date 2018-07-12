<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public const items = [
        'PENDING',
        'CONFIRMED',
        'COMPLETED',
    ];

    public static function seedStatus()
    {
        foreach(Status::items as $item){
            $s = new Status();
            $s->details = $item;
            $s->save();
        }
    }

    public static function statusID($status)
    {
        $k = Status::all();
        if($k->count() != count(Status::items) ){
            //Status::truncate();
            Status::seedStatus();
            $k = Status::all();
        }
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

    public static function GODOWN()
    {
        $id = Status::statusID("GODOWN");
        return Status::find($id);
    }

    public static function SITE()
    {
        $id = Status::statusID("SITE");
        return Status::find($id);
    }

    public static function COMPLETED()
    {
        $id = Status::statusID("COMPLETED");
        return Status::find($id);
    }

    public static function ACTIVE()
    {
        $id = Status::statusID("ACTIVE");
        return Status::find($id);
    }
}
