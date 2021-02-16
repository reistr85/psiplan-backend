<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class TypeServiceEnum extends Enum
{
    public const TYPE_SERVICE_ONLINE = 1;
    public const TYPE_SERVICE_PRESENTIAL = 2;
    public const TYPE_USER_ID_ADMIN = 1;
    public const TYPE_USER_ID_PSYCHOLOGIST = 2;
    public const TYPE_USER_ID_CLIENT = 3;
}
