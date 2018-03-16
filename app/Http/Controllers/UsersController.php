<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    /**
     * Testing that a new User model gets created
     *
     */
    public function addNewUser()
    {
        $user = new User;
        $user->username = "dankEngine" . rand(100, 999);
        $user->email = str_random(5) . "@gmail.com";
        $user->password = str_random(5);
        $user->save();

        return $user;
    }
}
