<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use JWTFactory;
use JWTAuth;
use Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
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
