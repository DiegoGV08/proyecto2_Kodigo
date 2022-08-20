<?php

namespace Tests\Unit;


use Tests\TestCase;

class ProductTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_successfully_get_product()
    {
        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        $response = $this->getJson('/api/product');

        $response->assertJsonStructure(['current_page','data']);

        $response->assertStatus(200);

    }

}
