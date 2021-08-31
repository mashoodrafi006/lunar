<?php

use Illuminate\Http\Response;

if(!function_exists('configuration')){
    function configuration(){
        return [
            'WAREHOUSE_TO_EARTH_SPACESTATION_TIME' => 1,
            'EARTH_TO_LUNAR_COLONY' => 3,
            'STATUS_CODES' => [
                'BAD_REQUEST' => Response::HTTP_BAD_REQUEST,
                "SUCCESS" => Response::HTTP_OK
            ]
        ];
    }
}

return configuration();
