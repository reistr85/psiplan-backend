<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistNotificationRepository;
use Exception;

class UpdatePsychologistNotificationService extends PsychologistNotificationRepository
{
    /**
     * Update PsychologistNotification
     *
     * @param int $psychologist_id
     * @param int $notification_id
     * @param int $is_active
     * @throws Exception
     */
    public function execute(int $psychologist_id, int $notification_id, int $is_active): Void
    {
        $queryBuilder = parent::getPsychologistNotificationByPsychologistIdAndNotificationId($psychologist_id, $notification_id);

        if(!$psychologist_notification = $queryBuilder->first())
            throw new Exception("Erro ao atualizar a notificação.", 500);

        parent::update($psychologist_notification, ['is_active' => $is_active]);
    }
}
