<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class NotificationsEnum extends Enum
{
    public const NOTIFICATION_NEW_QUERY = [
        'id' => 1,
        'title' => 'Nova consulta',
        'description' => 'Você tem uma nova consulta agendada.',
    ];

    public const NOTIFICATION_FIRST_CONSULTATION_FREE = [
        'id' => 2,
        'title' => 'Solicitação de consulta grátis',
        'description' => 'Você tem uma nova solicitação para consulta grátis. Acesse o seu e-mail para ver mais detalhes.',
    ];
}
