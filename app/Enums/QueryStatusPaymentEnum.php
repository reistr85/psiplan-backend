<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class QueryStatusPaymentEnum extends Enum
{
    public const STATUS_PAYMENT_PAID = 'paid';
    public const STATUS_PAYMENT_UNPAID = 'unpaid';
}
