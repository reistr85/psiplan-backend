<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class NotificationsStatusEnum extends Enum
{
    public const STATUS_NOT_READ = 'not_read';
    public const STATUS_READ = 'read';
}
