<?php

namespace Tests\Unit;


use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_successfullyLogin()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $response->assertStatus(200);
    }

    public function test_failedLogin()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEssV', 'password' => 'admin123']);
        $response->assertStatus(404);
    }

    public function test_successfullyToken()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();
        if (isset($json['token'])) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function test_get_login_user_success()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        if (isset($user['id']) && is_numeric($user['id'])) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function test_get_login_user_failed()
    {

        $response = $this->get('/api/login/user');
        $response -> assertStatus(500);

    }


}
