<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class NumberController extends Controller
{

    public function countNumbersWithoutFive($start , $to)
    {
        $startNumber =(int)$start;
        $endNumber = $to;
        $numbers=[];

        $count = 0;
        for ($i = $startNumber; $i <= $endNumber; $i++) {
            if (!$this->hasDigit($i, 5)) {
                $count++;
                array_push($numbers,$i);
            }
        }

        return response()->json(['count' => $count,'num'=>$numbers]);
    }

    private function hasDigit($number, $digit)
    {
        return strpos((string)$number, (string)$digit) !== false;
    }
}
