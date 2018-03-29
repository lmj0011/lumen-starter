<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UsersApiTest extends TestCase
{

   use DatabaseMigrations;

   public function setUp(): void
   {
     parent::setUp();

     $this->user1 = factory('App\Models\User')->make();
     $this->user2 = factory('App\Models\User')->make();
     $this->user3 = factory('App\Models\User')->make();
   }

    /**
     * Test Route 'store.user'
     * @return void
     */
    public function testStoreUser(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ])->seeJson([
          'username' => $this->user1->username,
          'email' => $this->user1->email,
       ]);
    }

    /**
     * Test Route 'index.user'
     * @return void
     */
    public function testGetUsers(): void
    {
        $this->post('api/v1/user', [
          'username' => $this->user1->username,
          'email' => $this->user1->email,
          'password' => $this->user1->password,
        ]);

        $this->post('api/v1/user', [
          'username' => $this->user2->username,
          'email' => $this->user2->email,
          'password' => $this->user2->password,
        ]);

        $this->post('api/v1/user', [
          'username' => $this->user3->username,
          'email' => $this->user3->email,
          'password' => $this->user3->password,
        ]);

        /////////

        $this->get('api/v1/user')->seeJson([
          'username' => $this->user1->username,
          'email' => $this->user1->email,
       ]);

       $this->get('api/v1/user')->seeJson([
         'username' => $this->user2->username,
         'email' => $this->user2->email,
       ]);

        $this->get('api/v1/user')->seeJson([
          'username' => $this->user3->username,
          'email' => $this->user3->email,
       ]);
    }

    /**
     * Test Route 'show.user'
     * @return void
     */
    public function testGetUserById(): void
    {
      $this->post('api/v1/user', [
        'username' => $this->user1->username,
        'email' => $this->user1->email,
        'password' => $this->user1->password,
      ]);

      $this->get('api/v1/user/1')->seeJson([
        'username' => $this->user1->username,
        'email' => $this->user1->email,
     ]);
    }

    /**
     * Test Route 'update.user'
     * @return void
     */
    public function testUpdateUser(): void
    {
      $email = 'xxxtestxxx@gmail.com';

      $this->post('api/v1/user', [
        'username' => $this->user1->username,
        'email' => $this->user1->email,
        'password' => $this->user1->password,
      ]);

      $this->put('api/v1/user/1', ['email' => $email])->seeJson([
        'email' => $email,
      ]);
    }

    /**
     * Test Route 'destroy.user'
     * @return void
     */
    public function testDeleteUser(): void
    {
      $this->post('api/v1/user', [
        'username' => $this->user1->username,
        'email' => $this->user1->email,
        'password' => $this->user1->password,
      ]);

      $this->delete('api/v1/user/1')->seeJson([
        'User:' . $this->user1->username . ' Removed.'
      ]);
    }
}
