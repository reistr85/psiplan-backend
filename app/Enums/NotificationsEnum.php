<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

class NotificationsEnum extends Enum
{
    public const NOTIFICATIONS = [
        'id' => 1,
        'type_user' => 2,
        'title' => 'Nova consulta',
        'description' => 'Você tem uma nova consulta agendada.',
        'url' => '/conta/notificacoes',
        'url_action' => '/gestao/consultas',
        'is_active' => 1,
    ];
}
