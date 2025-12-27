<?php

namespace App\Shared\Utils;

use DateTime;
use DateTimeZone;

class DateFormatter
{

    public static function toIso8601(string|null $date, string $timezone = 'Indian/Antananarivo'): ?string
    {
        if ($date === null) {
            return null;
        }

        if (is_string($date)) {
            $date = new DateTime($date, new DateTimeZone('UTC'));
        }

        $date->setTimezone(new DateTimeZone($timezone));
        return $date->format(DateTime::ATOM);
    }

}