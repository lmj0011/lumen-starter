<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UsersApiTest extends TestCase
{

   use DatabaseMigrations;

   public function setUp(): void
   {
     parent::setUp();
     $this->artisan('db:seed');

     $this->rootUser = User::find(1);

     $this->user2 = factory('App\Models\User')->make();
     $this->user3 = factory('App\Models\User')->make();
     $this->user4 = factory('App\Models\User')->make();
   }

    /**
     * Test Route 'store.user'
     * @group api
     * @return void
     */
    public function testStoreUser(): void
    {
        $root = $this->rootUser;

        $this->actingAs($root)->post('api/v1/user', [
          'username' => $this->user2->username,
          'email' => $this->user2->email,
          'password' => $this->user2->password,
        ])->seeJson([
          'username' => $this->user2->username,
          'email' => $this->user2->email,
       ]);
    }

    /**
     * Test Route 'index.user'
     * @group api
     * @return void
     */
    public function testGetUsers(): void
    {
        $root = $this->rootUser;

        $this->user2->save();
        $this->user3->save();
        $this->user4->save();

        // each key/value pair gets matched, even if it's a duplicate
        $this->actingAs($root)->get('api/v1/user')->seeJson([
          'username' => $this->user2->username,
          'email' => $this->user2->email,
          'username' => $this->user3->username,
          'email' => $this->user3->email,
          'username' => $this->user4->username,
          'email' => $this->user4->email,
       ]);
    }

    /**
     * Test Route 'show.user'
     * @group api
     * @return void
     */
    public function testGetUserById(): void
    {
      $root = $this->rootUser;

      $this->user2->save();

      $this->actingAs($root)->get('api/v1/user/2')->seeJson([
        'username' => $this->user2->username,
        'email' => $this->user2->email,
     ]);
    }

    /**
     * Test Route 'update.user'
     * @group api
     * @return void
     */
    public function testUpdateUser(): void
    {
      $root = $this->rootUser;
      $email = 'xxxtestxxx@gmail.com';

      $this->user2->save();

      $this->actingAs($root)->put('api/v1/user/1', ['email' => $email])->seeJson([
        'email' => $email,
      ]);
    }

    /**
     * Test Route 'destroy.user'
     * @group api
     * @return void
     */
    public function testDeleteUser(): void
    {
      $root = $this->rootUser;

      $this->user2->save();

      $this->actingAs($root)->delete('api/v1/user/2')->seeJson([
        'message' => 'User:' . $this->user2->username . ' Removed.'
      ]);
    }

    /**
     * Test Route 'destroy.user'
     * Non-root user should not be able to delete another User
     *
     * @group api
     * @return void
     */
    public function testUnauthDeleteUser(): void
    {
      $root = $this->rootUser;

      $this->user2->save();
      $this->user3->save();

      $nonRoot = User::find(2);


      $this->actingAs($nonRoot)->delete('api/v1/user/3')->seeJson([
        'error' => 'Insufficient Permissions.'
      ]);
    }

    /**
     * Test Route 'destroy.user'
     * Logged in user should not be able to delete itself
     *
     * @group api
     * @return void
     */
    public function testDeleteSelf(): void
    {
      $root = $this->rootUser;

      $this->actingAs($root)->delete('api/v1/user/1')->seeJson([
        'error' => 'The auth user cannot delete itself.'
      ]);
    }
}
