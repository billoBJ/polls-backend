<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exeption;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request){
        try{

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Error in email or password',
                    'message' => 'Unauthorized'
                ])->setStatusCode(401);
            }

            //get User
            $user = User::where('email',$request->email)->first();

            return $this->respondWithToken($token);


        }catch(\Exception $error){

            return response()->json([
                'message' => 'Internal Error - Login',
                'error' => $error->getMessage()
            ])->setStatusCode(500);

        }

    }

    public function getUser(){
        try{

            return response()->json(JWTAuth::user())->setStatusCode(200);
        }catch(\Exception $error){

            return false;
        }

    }

    public function logout(){
        try{
            Auth::logout();

            return response()->json(['message' => 'Successfully logged out'])->setStatusCode(200);
        }catch(\Exeption $error){
            return response()->json([
                'message' => 'Internal Error - Logout',
                'error' => $error->getMessage()
            ])->setStatusCode(500);
        }

    }


    private function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ])->setStatusCode(200);
    }

}
