<?php

use CodeIgniter\I18n\Time;

function daysPerMonth()
{
    $days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    return $days;
}

function dailySaving($target_nominal, $target_duration)
{
    $result = number_format($target_nominal / ($target_duration * daysPerMonth()));
    return $result;
}

function monthlySaving($target_nominal, $target_duration)
{
    $result = number_format($target_nominal / $target_duration);
    return $result;
}

function humanTime($created_time)
{
    $timeZone = 'Asia/Jakarta';
    $currentTime = Time::now($timeZone, 'en_US');
    $result = Time::parse($created_time, $timeZone);

    $diff = $currentTime->difference($result);

    return $diff->humanize();
}
