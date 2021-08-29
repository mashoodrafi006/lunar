<?php
function configuration(){
    return [
        'WAREHOUSE_TO_EARTH_SPACESTATION_TIME' => 1,
        'EARTH_TO_LUNAR_COLONY' => 3,
        'STATUS_CODES' => [
            'BAD_REQUEST' => 500,
            "SUCCESS" => 200
        ]
    ];
}

return configuration();
