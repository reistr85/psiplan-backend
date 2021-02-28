<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class QueryStatusEvaluationEnum extends Enum
{
    public const STATUS_EVALUATION_NOT_EVALUATED = 'not_evaluated';
    public const STATUS_EVALUATION_EVALUATED = 'evaluated';
}
