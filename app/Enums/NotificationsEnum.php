<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class NotificationsEnum extends Enum
{
    public const NOTIFICATIONS = [
        'id' => 1,
        'type_user' => 2,
        'title' => 'Nova consulta agendada',
        'description' => 'Você tem uma nova consulta agendada. Clique aqui para ver mais detalhes.',
        'url' => 'notificacoes',
        'is_active' => 1,
    ];

}
