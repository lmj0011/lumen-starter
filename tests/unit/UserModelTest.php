<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UsersModelTest extends TestCase
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
     * Test the methods on the User Model
     *
     * @group unit
     * @return void
     */
    public function testUserModelMethods(): void
    {
      $root = $this->rootUser;

      $this->actingAs($root)->post('api/v1/user', [
        'username' => $this->user2->username,
        'email' => $this->user2->email,
        'password' => $this->user2->password,
      ]);

      $nonRoot = User::find(2);

      $this->assertEquals($root->getJWTIdentifier(), 1);
      $this->assertEquals($root->getJWTCustomClaims(), []);
      $this->assertEquals($root->isRootUser(), true);

      $this->assertEquals($nonRoot->getJWTIdentifier(), 2);
      $this->assertEquals($nonRoot->getJWTCustomClaims(), []);
      $this->assertEquals($nonRoot->isRootUser(), false);
    }

}
