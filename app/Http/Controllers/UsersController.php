<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\RestfulModelInterface;

class UsersController extends Controller implements RestfulModelInterface
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


  /**
   * Return all Users.
   *
   */
    public function index(Request $request): JsonResponse
    {
     $users  = User::all();

     return response()->json($users);
    }

  /**
   * Return a User by id.
   *
   */
   public function show(Request $request, $id): JsonResponse
   {
     $user = User::find($id);

     return response()->json($user);
   }

/**
 * Create a new User.
 *
 */
  public function store(Request $request): JsonResponse
  {
    $user = new User;
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return  response()->json($user);
  }

/**
 * Update a User by id.
 *
 */
  public function update(Request $request, $id): JsonResponse
  {
    $user = User::find($id);

    if ($request->input('username')) {
      $user->username = $request->input('username');
    }

    if ($request->input('email')) {
      $user->email = $request->input('email');
    }

  	$user->save();

    return response()->json($user);
  }

/**
 * Destroy a User by id.
 *
 */
  public function destroy(Request $request, $id): JsonResponse
  {
    $user = User::find($id);

  	$user->delete();

    return response()->json('User:' . $user->username . ' Removed.');
  }
}
