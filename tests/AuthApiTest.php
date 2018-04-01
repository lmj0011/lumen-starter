<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class AuthApiTest extends TestCase
{

   use DatabaseMigrations;

   public function setUp(): void
   {
     parent::setUp();

     $this->user1 = factory('App\Models\User')->make();
   }

    /**
     * Test Route 'auth.login'
     * @return void
     */
    public function testLogin(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);


        $this->post('api/v1/auth/login', [
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ])->seeJsonStructure([
          'access_token'
        ])
        ->seeJson([
          'token_type' => 'bearer',
          'expires_in' => 3600,
       ]);
    }

    /**
     * Test Route 'auth.logout'
     * @return void
     */
    public function testLogout(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);

        // login
        $this->post('api/v1/auth/login', [
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);


        $this->post('api/v1/auth/logout')
        ->seeJson(['message' => 'Successfully logged out']);
    }

    /**
     * Test Route 'auth.me'
     *
     * Surprisingly works without having to explicitly disable Middleware
     * @return void
     */
    public function testMe(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);

        // login
        $this->post('api/v1/auth/login', [
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);


        $this->post('api/v1/auth/me', [
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ])
        ->seeJson([
          'username' => $this->user1->username,
       ]);

    }

    /**
     * Test Route 'auth.refresh'
     * @return void
     */
    public function testRefresh(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);

        // login
        $this->post('api/v1/auth/login', [
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);


        $this->post('api/v1/auth/refresh')
        ->seeJsonStructure([
          'access_token'
        ])
        ->seeJson([
          'token_type' => 'bearer',
          'expires_in' => 3600,
       ]);
    }

}
