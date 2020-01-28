<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use JWTFactory;
use JWTAuth;
use Response;
use Illuminate\Support\Facades\Auth;
/**
 * @OA\Info(title="Book API", version="0.1")
 */

/**
  *@OA\SecurityScheme(securityScheme="bearerAuth",type="http",scheme="bearer", bearerFormat="JWT"  ),
 */

class AuthController extends Controller
{

/**
 * @OA\Post(
 *     path="/register",
 *     @OA\Response(response="200", description="An example resource")
 * )
 *
 */


    public function register(Request $request)
    {
       $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'=> 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }


      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $user = User::first();
      $token = JWTAuth::fromUser($user);

      return $this->respondWithToken($token);
    }
    /**
     * @OA\Post(path="/login",
     *   tags={"login"},
     *   summary="Logs user into the system",
     *   description="",
     *   operationId="login",
     *   @OA\Parameter(
     *     name="email",
     *     required=true,
     *     in="query",
     *     description="The email for login",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     in="query",
     *     @OA\Schema(
     *         type="string",
     *     ),
     *     description="The password for login in clear text",
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(type="string"),
     *     @OA\Header(
     *       header="X-Rate-Limit",
     *       @OA\Schema(
     *           type="integer",
     *           format="int32"
     *       ),
     *       description="calls per hour allowed by the user"
     *     ),
     *     @OA\Header(
     *       header="X-Expires-After",
     *       @OA\Schema(
     *          type="string",
     *          format="date-time",
     *       ),
     *       description="date in UTC when token expires"
     *     )
     *   ),
     *   @OA\Response(response=400, description="Invalid username/password supplied")
     * )
     */
    public function login(Request $request)
    {

      $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }

     try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
      return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }
}
