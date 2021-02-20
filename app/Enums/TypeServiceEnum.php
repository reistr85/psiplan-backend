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
    public const PLAN_ID_SIMPLE_TRI = 1;
    public const PLAN_ID_HASH_SIMPLE_TRI = 'jR';
    public const PLAN_ID_SIMPLE_SEM = 2;
    public const PLAN_ID_HASH_SIMPLE_SEM = 'k5';
    public const PLAN_ID_ECONOMIC_TRI = 3;
    public const PLAN_ID_HASH_ECONOMIC_TRI = 'l5';
    public const PLAN_ID_ECONOMIC_SEM = 4;
    public const PLAN_ID_HASH_ECONOMIC_SEM = 'mO';
    public const PLAN_ID_PREMIUM_TRI = 5;
    public const PLAN_ID_HASH_PREMIUM_TRI = 'nR';
    public const PLAN_ID_PREMIUM_SEM = 6;
    public const PLAN_ID_HASH_PREMIUM_SEM = 'oj';
    public const PERCENTAGE_AVATAR_VALUE = 20;
    public const PERCENTAGE_YOUTUBE_VALUE = 5;
    public const PERCENTAGE_GALLERY_VALUE = 5;
    public const PERCENTAGE_DESCRIPTION_VALUE = 10;
    public const PERCENTAGE_SPECIALTY_VALUE = 10;
    public const PERCENTAGE_FORMATION_VALUE = 10;
    public const PERCENTAGE_APPROACH_VALUE = 10;
    public const PERCENTAGE_DOC_CRP_VALUE = 10;
    public const PERCENTAGE_DOC_ADDRESS_VALUE = 10;
    public const PERCENTAGE_DOC_CERTIFICATE_VALUE = 10;
    public const PERCENTAGE_DOC_EPSI_VALUE = 10;
}
