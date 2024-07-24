<?php

namespace App\Helpers;

class DateHelper
{
    public static function formatTime($time)
    {
        $hours = floor($time / 60);
        $minutes = $time % 60;

        return ($hours > 0 ? $hours . ' hrs ' : '') . ($minutes > 0 ? $minutes . ' mins' : '');
    }
}
