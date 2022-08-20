<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_successfully_get_user()
    {

        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        $response = $this->getJson('/api/user');

        $response->assertJsonStructure(['current_page','data']);

        $response->assertStatus(200);

    }

    public function test_successfully_post_user()
    {

        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        $this->postJson('/api/user', ['name' => 'admin2', 'last_name' => 'hernandez', 'email'=> Str::random(10)."@gmail.com", 'username' => 'ADMIN5', 'password' => 'admin5'])->assertStatus(200);

    }

    public function test_succesfully_delete_user(){

        $response = $this->postJson('/api/login', ['username' => 'DEGV', 'password' => 'admin123']);
        $json = $response->decodeResponseJson();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $json['token']])->get('/api/login/user');
        $user = $response->decodeResponseJson();

        $usuario = new User();

        $usuario->name = "UsuarioTest";
        $usuario->last_name = "ApellidoTest";
        $usuario->email = Str::random(10)."@gmail.com";
        $usuario->username = "Test";
        $usuario->password = bcrypt("admintest");

        $usuario->save();

        $this->delete("api/user/$usuario->id")->assertStatus(200);


    }


}

