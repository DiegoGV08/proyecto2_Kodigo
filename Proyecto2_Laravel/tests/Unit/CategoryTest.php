<?php

namespace Tests\Unit;


use Tests\TestCase;

class CategoryTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_successfully_get_category()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        $response = $this->getJson('/api/category');

        $response->assertJsonStructure(['current_page','data']);

        $response->assertStatus(200);

    }

}
