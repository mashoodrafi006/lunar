<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Closure;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class ValidateDispatchTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if(!is_null($request->get('dispatchTime'))){
                $dispatchTime = $request->get('dispatchTime');
                new Carbon($dispatchTime);
                return $next($request);
            }else{
                return response()->json(['status' => config("constants.STATUS_CODES.BAD_REQUEST"), 'message'=>'Pass dispatchTime as parameter.','body'=> "Dispatch time missing."]);
            }
        }catch (\Exception $exception){
            return response()->json(['status' => config("constants.STATUS_CODES.BAD_REQUEST"), 'message'=>'Pass time in correct format.','body'=> $exception->getMessage()]);
        }
    }
}
