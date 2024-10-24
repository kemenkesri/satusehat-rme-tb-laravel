<?php

/**
 * @param string $date
 * @return string
 * @throws \Exception
 */
function parseDateTimeWithTimezone(string $date): string
{
    return (new DateTime(
        date('Y-m-d H:i:s',
            strtotime('-4 sec',
                strtotime($date . ' ' . date('H:i:s'))
            ))
    ))->setTimezone(new DateTimeZone('UTC'))->format('c');
}

/**
 * @param string $date
 * @return string
 * @throws \Exception
 */
function parseDateTime(string $date): string
{
    return date('Y-m-d h:i:s',strtotime($date));
}
