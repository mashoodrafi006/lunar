<?php

namespace App\Http\Services;

use Carbon\Carbon;

class LunarService{
    const WAREHOUSE_TO_EARTH_SPACESTATION_TIME = 1;
    const EARTH_TO_LUNAR_COLONY = 3;

    public function getLunarDeliveryTime($dispatchTime){
        $timeOfPackageDispatchFromWarehouse = new Carbon($dispatchTime);
        $timeToReachLunarColony = $timeOfPackageDispatchFromWarehouse->addDay(self::WAREHOUSE_TO_EARTH_SPACESTATION_TIME + self::EARTH_TO_LUNAR_COLONY);
        return ($this->calculateLunarTime($timeToReachLunarColony->timestamp));
    }
    public function calculateLunarTime($dispatchTime = null)
    {
        $secondsInOneLunarYear = 12*30*24*60*60;
        $lunarSecondsInOneDay = 30*24*60*60;
        $lunarSecondsInOneCycle = 24*60*60;
        $lunarSecondsInOneHour = 60*60;
        $lunarSecondsInOneMinute = 60;
        $lunarEpochTime = 14159025;

        /* Since Epoch started from 1st Jan 1970, so to get the epoch since Lunar */
        $totalSecondsFromEpoch = $dispatchTime + $lunarEpochTime;
        $lunarSecondEpoc = (int) ($totalSecondsFromEpoch / 0.984352966667);
        $years = floor($lunarSecondEpoc / $secondsInOneLunarYear) + 1;
        $days = floor($lunarSecondEpoc % $secondsInOneLunarYear / $lunarSecondsInOneDay) + 1;
        $cycles = floor($lunarSecondEpoc % $lunarSecondsInOneDay / $lunarSecondsInOneCycle) + 1;
        $hours = floor($lunarSecondEpoc % $lunarSecondsInOneCycle / $lunarSecondsInOneHour);
        $minutes = floor($lunarSecondEpoc % $lunarSecondsInOneHour / $lunarSecondsInOneMinute);
        $seconds = floor($lunarSecondEpoc % $lunarSecondsInOneMinute);

        return ($years. "-" . $days . "-" . $cycles . " ". $hours . ":" . $minutes . ":" . $seconds);
    }
}
