<?php

namespace App\Http\Controllers;

use App\Http\Services\LunarService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LunarController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getLunarDeliveryTime(\Illuminate\Http\Request $request, LunarService $lunarService){
        try{
            $dispatchTime = $request->get("dispatchTime");
            $lunarDeliveryTime = $lunarService->getLunarDeliveryTime($dispatchTime);

            return response()->json(['status' => config("constants.STATUS_CODES.SUCCESS"), 'message'=>'success','body'=> $lunarDeliveryTime]);
        }catch (\Exception $exception){
            return response()->json(['status' => config("constants.STATUS_CODES.BAD_REQUEST"), 'message'=>'success','body'=> $exception->getMessage()]);
        }

    }
}
