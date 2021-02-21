<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetAllPsychologistPreferencesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_psychologist_preferences()
    {
        $response = $this
            ->withHeaders([
                'ApiKey' => $this->apiKey,
                'Authorization' => $this->access_token,
            ])
            ->get('api/psiplan/v1/account/preferences');

        $response->assertStatus(200);

        $json = json_decode($response->getContent());
        $count_all_preferences = count($json->preferences);
        $count_psychologist = count($json->psychologist_preferences);

        $this->assertEquals($count_psychologist, $count_all_preferences);
    }
}
