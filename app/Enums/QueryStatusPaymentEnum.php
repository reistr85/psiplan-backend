<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class QueryStatusPaymentEnum extends Enum
{
    public const STATUS_PAYMENT_UNPAID = 'unpaid';
    public const STATUS_PAYMENT_PROCESSING = 'processing';
    public const STATUS_PAYMENT_AUTHORIZED = 'authorized';
    public const STATUS_PAYMENT_PAID = 'paid';
    public const STATUS_PAYMENT_REFUSED = 'refunded';
    public const STATUS_PAYMENT_WAITING = 'waiting_payment';
    public const STATUS_PAYMENT_PENDING_REFUND = 'pending_refund';
    public const STATUS_PAYMENT_CHARGEDBACK = 'chargedback';
    public const STATUS_PAYMENT_ANALYZING = 'analyzing';
    public const STATUS_PAYMENT_PENDING_REVIEW = 'pending_review';
}
