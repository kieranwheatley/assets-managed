<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     //Test the test works
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
