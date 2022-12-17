<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    //gera um usuario por comando cmd
    //php artisan tinker
    //DB::table('users')->insert(['name'=>'Marcos MTS','email'=>'marcosmatthies@gmail.com','password'=>Hash::make('123456')])


    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password']
        ];

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout efetuado!']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'user_level' => auth()->user()->users_levels_id,
            'user_image' => auth()->user()->image,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
