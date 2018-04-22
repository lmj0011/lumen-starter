<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'username' => 'root',
          'email' => 'root@gmails.com',
          'password' => Hash::make('password1'),
          'created_at'    => Carbon::now(),
          'updated_at'    => Carbon::now(),
      ]);
    }
}
