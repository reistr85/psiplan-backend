<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $apiKey = 'base64:5TetPRa/6TSFN+aqOfZHqJmkHzb+THnb38fcC4B1ICI=';
    public $access_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjkwMDEvYXBpL3BzaXBsYW4vdjEvbG9naW4iLCJpYXQiOjE2MTM4NjM0NjksImV4cCI6MTYxMzg2NzA2OSwibmJmIjoxNjEzODYzNDY5LCJqdGkiOiJEYzNBQ3V4azROVXlaS29pIiwic3ViIjoyLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.GMUV8wHK5y6aF1pvhTLZZF0kPlb4u49H80L7PftMux4';
}
