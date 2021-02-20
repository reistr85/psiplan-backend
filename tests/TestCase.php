<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $apiKey = 'base64:5TetPRa/6TSFN+aqOfZHqJmkHzb+THnb38fcC4B1ICI=';
    public $access_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjkwMDEvYXBpL3BzaXBsYW4vdjEvbG9naW4iLCJpYXQiOjE2MTM4NTMxOTAsImV4cCI6MTYxMzg1Njc5MCwibmJmIjoxNjEzODUzMTkwLCJqdGkiOiJwb0Q5WENrZTJkR1l0ZmpkIiwic3ViIjoyLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.kqnhKGWRLgXiRvDJ_QZ-J5FB6VzZ_47JCXc2MAzsviM';
}
