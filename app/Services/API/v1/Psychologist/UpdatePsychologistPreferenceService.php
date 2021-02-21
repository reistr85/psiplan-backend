<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistNotificationRepository;
use Exception;

class UpdatePsychologistPreferenceService extends PsychologistNotificationRepository
{
    /**
     * Update PsychologistPreference
     *
     * @param int $psychologist_id
     * @param int $preference_id
     * @param int $is_active
     * @return Void
     * @throws Exception
     */
    public function execute(int $psychologist_id, int $preference_id, int $is_active): Void
    {
        $psychologist_preference = parent::getPsychologistPreferenceByPsychologistIdAndPreferenceId($psychologist_id, $preference_id);

        if(!$psychologist_preference->first())
            throw new Exception("Erro ao atualizar a notificação.", 500);

        $return = parent::update($psychologist_preference->first(), ['is_active' => $is_active]);

        if(!$return)
            throw new Exception("Erro ao atualizar a notificação.", 500);
    }
}
