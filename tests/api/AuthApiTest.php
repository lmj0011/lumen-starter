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
     $this->artisan('db:seed');

     $this->rootUser = User::find(1);

     $this->user2 = factory('App\Models\User')->make();
   }

    /**
     * Test Route 'auth.login'
     * @group api
     * @return void
     */
    public function testLogin(): void
    {
      $root = $this->rootUser;

      $this->post('api/v1/auth/login', [
          'email' => $root->email,
          'password' => 'password1',
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
     * @group api
     * @return void
     */
    public function testLogout(): void
    {
      $root = $this->rootUser;

      $this->post('api/v1/auth/login', [
          'email' => $root->email,
          'password' => 'password1',
        ]);
        
      $this->actingAs($root)->post('api/v1/auth/logout')
        ->seeJson(['message' => 'Successfully logged out']);
    }

    /**
     * Test Route 'auth.me'
     * Surprisingly works without having to explicitly disable Middleware
     * @group api
     * @return void
     */
    public function testMe(): void
    {
      $root = $this->rootUser;

      $this->actingAs($root)->post('api/v1/auth/me')
        ->seeJson([
          'username' => $root->username,
          'email' => $root->email,
       ]);

    }

    /**
     * Test Route 'auth.refresh'
     * @group api
     * @return void
     */
    public function testRefresh(): void
    {
        $root = $this->rootUser;

        $this->post('api/v1/auth/login', [
            'email' => $root->email,
            'password' => 'password1',
          ]);

        $this->actingAs($root)->post('api/v1/auth/refresh')
        ->seeJsonStructure([
          'access_token'
        ])
        ->seeJson([
          'token_type' => 'bearer',
          'expires_in' => 3600,
       ]);
    }

}
