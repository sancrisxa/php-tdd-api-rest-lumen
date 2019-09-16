<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $dados = [
            'name' => 'Nome 01',
            'email' => 'email@email.com',
            'password' => '123',
        ];

        $this->post('/api/user', $dados);

        $this->assertResponseOK();
    }
}
