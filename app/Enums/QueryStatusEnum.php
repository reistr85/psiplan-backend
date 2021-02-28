<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class QueryStatusEnum extends Enum
{
    public const STATUS_QUERY_SCHEDULED = 'scheduled';
    public const STATUS_QUERY_CONFIRMED = 'confirmed';
    public const STATUS_QUERY_FULFILLED = 'fulfilled';
}
