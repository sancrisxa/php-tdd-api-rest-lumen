<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $dados = [
            'name' => 'Nome 01',
            'email' => 'email01@email.com',
            'password' => '123',
        ];

        $this->post('/api/user', $dados);

        $this->assertResponseOK();

        $resposta = (array) json_decode($this->response->content());

        $this->assertArrayHasKey('name', $resposta);
        $this->assertArrayHasKey('email', $resposta);
        $this->assertArrayHasKey('id', $resposta);
    }

    public function testViewUser()
    {
        $user = \App\User::first();

        $this->get('/api/user/' . $user->id);

        $this->assertResponseOk();


        $resposta = (array) json_decode($this->response->content());

        $this->assertArrayHasKey('name', $resposta);
        $this->assertArrayHasKey('email', $resposta);
        $this->assertArrayHasKey('id', $resposta);


    }

    public function testUpdateUser()
    {
        $user = \App\User::first();
        $dados = [
            'name' => 'Nome 03',
            'email' => 'email03@email.com',
            'password' => '123',
        ];

        $this->put('/api/user/' . $user->id, $dados);

        $this->assertResponseOK();

        $resposta = (array) json_decode($this->response->content());

        $this->assertArrayHasKey('name', $resposta);
        $this->assertArrayHasKey('email', $resposta);
        $this->assertArrayHasKey('id', $resposta);

        $this->notSeeInDatabase('users', [
            'name' => $user->name,
            'email' => $user->email,
            'id' => $user->id,

        ]);
    }

}
