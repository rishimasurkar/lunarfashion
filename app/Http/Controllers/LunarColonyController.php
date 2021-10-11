<?php

namespace App\Http\Controllers;

use App\lunarColony;
use App\Traits\LunarColonyTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LunarColonyController extends Controller
{
    use LunarColonyTrait;

    private const EARTH_TIME_UTC = 'earth-time-utc';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getLunarTime(Request $request): JsonResponse
    {
        // Validate the query string.
        if(empty($request->getQueryString())) {
            throw new \Exception('No parameters passed, Invalid input !!!!');
        }

        // Get the time from API params
        $earthTime = $request->getQueryString();
        $strSplit = explode('=', $earthTime);

        if( self::EARTH_TIME_UTC !== $strSplit[0] || empty($strSplit[1])) {
            throw new \Exception(
                'Incorrect parameter!. Please use `earth-time-utc` as KEY & `yyyy-mm-dd HH:MM:SS` as VALUE in API param.'
            );
        }

        /*
         * Format time
         * time format UTC - yyyy-mm-dd HH:MM:SS
         * example UTC time - 2021-07-29 15:28:14
        */
        try {
            // Format the time
            $formattedTime = $this->formatTime($strSplit[1]);

            // Convert the time to LST
            $lunarDateTime = $this->convertTimeToLst($formattedTime);
        } catch (\Exception $e) {
            throw new \Exception('Error : ' . $e->getMessage());
        }

        return response()->json($lunarDateTime);
    }
}
