<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/7/2018
 * Time: 11:55 AM
 */

namespace App;


use Illuminate\Support\Facades\DB;

class Utility
{
    /**
     * @param $callback
     * @param $fail
     * @return bool
     * @throws \Exception
     */
    public static function runSqlSafely(callable $callback,callable $fail = null)
    {
        DB::beginTransaction();
        try{
            $value = $callback();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            if($fail) {
                return $fail($e);
            }
            throw $e;
        }
        DB::commit();
        return $value;
    }
}