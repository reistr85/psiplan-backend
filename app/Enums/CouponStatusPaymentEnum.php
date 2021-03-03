<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class CouponStatusPaymentEnum extends Enum
{
    public const STATUS_PAYMENT_PAID = 'paid';
    public const STATUS_PAYMENT_UNPAID = 'unpaid';
}
