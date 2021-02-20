<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_auth()
    {
        $request = [
            'email' => 'psiteste@gmail.com',
            'password' => '12345678'
        ];

        $response = $this
            ->withHeaders(['ApiKey' => $this->apiKey])
            ->post('api/psiplan/v1/login',
                $request
            );

        $response->assertStatus(200);
    }
}
