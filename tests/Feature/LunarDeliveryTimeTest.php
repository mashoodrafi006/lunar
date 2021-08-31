<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class LunarDeliveryTimeTest extends TestCase
{
    /**
     * Test success case where correct lunar delivery time is returned with all correct configurations.
     *
     * @return void
     */
    public function test_correct_lunar_delivery_time()
    {
        $this->withoutExceptionHandling();
        $this->json('get', 'api/lunar-delivery-time?dispatchTime=2021-08-29 10:09:09')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "status" => Response::HTTP_OK,
                "message" => "success",
                "body" => "54-9-19 21:31:40"
            ]);
    }

    /**
     * Test failed case where dispatchTime parameter is missing.
     *
     * @return void
     */
    public function test_lunar_delivery_time_failed_with_wrong_parameter(){
        $this->withoutExceptionHandling();
        $response = $this->json('get', 'api/lunar-delivery-time?wrong_parameter=2021-08-29 10:09:09')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "status" => Response::HTTP_BAD_REQUEST,
                "message" => "Pass dispatchTime as parameter.",
                "body" => "Dispatch time missing."
            ]);
    }

    /**
     * Test failed case where dispatchTime parameter is missing.
     *
     * @return void
     */
    public function test_lunar_delivery_time_failed_with_wrong_time(){
        $this->withoutExceptionHandling();
        $response = $this->json('get', 'api/lunar-delivery-time?dispatchTime=test')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "status" => Response::HTTP_BAD_REQUEST,
                "message" => "Pass time in correct format."
            ]);
    }
}
