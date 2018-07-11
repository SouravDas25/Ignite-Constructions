<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/11/2018
 * Time: 1:09 AM
 */

namespace App;


abstract class JourneyStatus
{
    const STARTED = 0;
    const REACHED_GODOWN = 1;
    const LEAVING_GODOWN = 2;
    const REACHED_SITE = 3;
    const LEAVING_SITE = 4;
    const COMPLETED = 5;

    public static function isTowardsGodown($heading)
    {
        if($heading === JourneyStatus::STARTED || $heading === JourneyStatus::LEAVING_SITE || $heading == JourneyStatus::REACHED_SITE )
        {
            return true;
        }
        return false;
    }

    public static function isTowardsSite($heading)
    {
        if( $heading === JourneyStatus::REACHED_GODOWN || $heading === JourneyStatus::LEAVING_GODOWN )
        {
            return true;
        }
        return false;
    }
}