<?php

namespace App\Helpers;

class DateHelper
{
    public static function formatTime($time)
    {
        $hours = floor($time / 60);
        $minutes = $time % 60;

        return ($hours > 0 ? $hours . 'h ' : '') . ($minutes > 0 ? $minutes . 'm' : '');
    }
}
