<?php

namespace App\Helpers;


class Amate
{
    public static function printR($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        return true;
    }

    public static function rusSklon($value, $case_1, $case_2, $case_3, $case_4)
    {
        $ost = $value % 10;
        if ($value >= 5 && $value <= 20) {
            $str = $case_1;
        } else if ($ost == 2 || $ost == 3 || $ost == 4) {
            $str = $case_2;
        } else if ($ost == 1) {
            $str = $case_3;
        } else {
            $str = $case_4;
        }
        return $value . ' ' . $str;
    }
}
