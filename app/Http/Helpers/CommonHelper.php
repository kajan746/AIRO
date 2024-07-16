<?php

namespace App\Http\Helpers;

use DateTime;

class CommonHelper
{
    public static function getCurrencyCodes()
    {
        $currencyCodes = [
            1 => 'EUR',
            2 => 'GBP',
            3 => 'USD',
        ];

        return $currencyCodes;
    }

    public static function getAgeLoadData() {
        return [
            ['min_age' => 18, 'max_age' => 30, 'value' => 0.6],
            ['min_age' => 31, 'max_age' => 40, 'value' => 0.7],
            ['min_age' => 41, 'max_age' => 50, 'value' => 0.8],
            ['min_age' => 51, 'max_age' => 60, 'value' => 0.9],
            ['min_age' => 61, 'max_age' => 70, 'value' => 1],
        ];
    }

    public static function getLoadForAge($age) {
        foreach (CommonHelper::getAgeLoadData() as $key => $ageLoad) {
            if ($ageLoad['min_age']<= $age && $age <= $ageLoad['max_age']) {
                return $ageLoad['value'];
            }
        }
    }

    public static function getDateTimeDifferenceFormat($fromDate, $toDate)
    {
        $date1 = new DateTime($fromDate);
        $date2 = new DateTime($toDate);
        $interval = $date1->diff($date2);
        return $interval->format('%a')+1;
    }

    public static function generateRandomCode($length =10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getDateTimeFormat($datetime, $format)
    {
        return date($format, strtotime($datetime));
    }
}
