<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Console\Command;

class GetLunarTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lunar:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timeOfPackageDispatchFromWarehouse = new Carbon('00:00:00');
        $timeToReachLunarColony = $timeOfPackageDispatchFromWarehouse->addDay(config('constants.WAREHOUSE_TO_EARTH_SPACESTATION_TIME') + config('constants.EARTH_TO_LUNAR_COLONY'));
        dd($this->calculateLunarTime("Y-d-c H:i:S T, D", $timeToReachLunarColony->timestamp));
    }
    public function calculateLunarTime($format_string, $dispatchTime = null)
    {
        $secondsInOneLunarYear = 12*30*24*60*60;
        $lunarSecondsInOneDay = 30*24*60*60;
        $lunarSecondsInOneCycle = 24*60*60;
        $lunarSecondsInOneHour = 60*60;
        $lunarSecondsInOneMinute = 60;
        $lunarEpochTime = 14159025;

        /** Since Epoch started from 1st Jan 1970, so to get the epoch since Lunar */
        $totalSecondsFromEpoch = $dispatchTime + $lunarEpochTime;

        $lunarSecondEpoc = (int) ($totalSecondsFromEpoch / 0.984352966667);

        /** Break into functions */
        $years = floor($lunarSecondEpoc / $secondsInOneLunarYear) + 1;
        $days = floor($lunarSecondEpoc % $secondsInOneLunarYear / $lunarSecondsInOneDay) + 1;
        $cycles = floor($lunarSecondEpoc % $lunarSecondsInOneDay / $lunarSecondsInOneCycle) + 1;
        $hours = floor($lunarSecondEpoc % $lunarSecondsInOneCycle / $lunarSecondsInOneHour);
        $minutes = floor($lunarSecondEpoc % $lunarSecondsInOneHour / $lunarSecondsInOneMinute);
        $seconds = floor($lunarSecondEpoc % $lunarSecondsInOneMinute);
        dd ($years. "-" . $days . "-" . $cycles . " ". $hours . ":" . $minutes . ":" . $seconds);

        return ($years. "-" . $days . "-" . $cycles . " ". $hours . ":" . $minutes . ":" . $seconds);
    }

}
