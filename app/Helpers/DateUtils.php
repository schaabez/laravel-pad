<?php

namespace App\Helpers;

class DateUtils {

    public static function getWorkingHourRange(\DateTime $start, \DateTime $end): int {
        $whDiff = $start->diff($end);
        $minutes = $whDiff->i + ($whDiff->h * 60) + ($whDiff->s / 60);
        return $whDiff->invert ? -$minutes : $minutes;
    }

    public static function setDate(\DateTime $date, \DateTime $time): \DateTime {
        $date->setDate($time->format("Y"), $time->format("m"), $time->format("d"));
        return $date;
    }


    public static function setTime(\DateTime $date, \DateTime $time): \DateTime {
        $date->setTime($time->format("H"), $time->format("i"), $time->format("s"));
        return $date;
    }

}
