<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class NotificationsEnum extends Enum
{
    public const NOTIFICATION_NEW_QUERY = [
        'id' => 1,
        'title' => 'Nova consulta',
        'description' => 'Você tem uma nova consulta agendada.',
        'details' => 'yes'
    ];

    public const NOTIFICATION_FIRST_CONSULTATION_FREE = [
        'id' => 2,
        'title' => 'Solicitação de consulta grátis',
        'description' => 'Você tem uma nova solicitação para consulta grátis. Acesse o seu e-mail para ver mais detalhes.',
        'details' => 'not'
    ];

    public const NOTIFICATION_NEW_EVALUATION_PSYCHOLOGIST = [
        'id' => 3,
        'title' => 'Você tem uma nova avaliação',
        'description' => 'Você recebeu uma nova avaliação em seu perfil.',
        'details' => 'yes'
    ];

    public const NOTIFICATION_QUERY_CANCELED_CLIENT = [
        'id' => 4,
        'title' => 'Consulta cancelada',
        'description' => 'Sua consulta foi cancelada, verifique o seu e-mail para mais detalhes.',
        'details' => 'not'
    ];

    public const NOTIFICATION_NEW_EVALUATION_CLIENT = [
        'id' => 5,
        'title' => 'Avaliar psicólogo',
        'description' => 'Você tem um novo psicólogo para avaliar.',
        'details' => 'yes'
    ];
}
