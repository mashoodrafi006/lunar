<?php

namespace Tests\Unit;

use App\Http\Services\LunarService;
use PHPUnit\Framework\TestCase;

class LunarDeliveryTimeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_correct_lunar_delivery_time()
    {
        $dispatchTime = "2021-01-01 10:00";
        $lunarDeliveryTime =  (new LunarService())->getLunarDeliveryTime($dispatchTime);
        $this->assertEquals("54-1-16 1:48:47",$lunarDeliveryTime);
    }
}
