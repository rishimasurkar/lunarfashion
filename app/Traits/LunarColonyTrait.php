<?php

namespace App\Traits;

use \Datetime;

trait LunarColonyTrait {
    protected function formatTime(string $strEarthTimeUtc)
    {
        $strReplacedTime = str_replace('%3A',':', $strEarthTimeUtc);
        return str_replace('%20',' ', $strReplacedTime);
    }

    protected function convertTimeToLst(string $formattedTime)
    {
        // Time required from earth to moon is 3 days exactly.
        // Standard notation : Year-Day-Cycle ∇ Hour:Minute:Second
        // 1 day = 30 cycle of time = 3*30(90) cycle of time
        // 1 cycle = 24 moon-hours = 90*24(2160) moon-hours
        // 1 moon hour = 60 moon-minutes = 2160*60(129600) moon-minutes
        // 1 moon minutes = 60 moon-seconds = 129600*60(7776000) moon-seconds
        // 1 day = 2592000 sec
        // 3 days = 7776000 sec

        $lunarDate = $this->getLunarDateOnly($formattedTime);
        $lunarTime = $this->getLunarTimeOnly($formattedTime);

        return $lunarDate .' ∇ '. $lunarTime;
    }

    protected function getLunarTimeOnly(string $formattedTime) {
        $lunarTime = date('h:m:s', strtotime($formattedTime)+7776000);
        return $lunarTime;
    }

    protected function getLunarDateOnly(string $formattedTime) {
        $lunarDate = explode('-', explode(' ', $formattedTime)[0]);
        $year = $this->getYear($formattedTime);
        $month = $this->getMonth($lunarDate[1]);
        $day = $this->getDay($lunarDate[2]);

        return $year . '-' . $month . '-' . $day;
    }

    protected function getYear(string $formattedTime) {
        $date = explode(' ', $formattedTime)[0];

        if(explode('-', $date)[0] < '1969') {
            throw new \Exception('Invalid Year, year should be greater than 1969');
        }

        $date1 = new DateTime("1969-07-21");
        $date2 = new DateTime($date);
        $interval = $date1->diff($date2);

        return ceil(($interval->days/30)/12);
    }

    protected function getMonth(string $month) {
        if($month > 12 || $month <= 0) {
            throw new \Exception('Invalid Month, month should be >0 & <=12');
        }

        return (12 == $month) ? '01' : $month + 1;
    }

    // Could not complete this code.
    protected function getDay(string $day) {
        return $day;
    }
}
