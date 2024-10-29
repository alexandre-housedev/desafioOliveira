<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Login User
     * @param email email.
     * @param password password.
     * @response array{status: true, password: 'kasjdlkasjdlk'}}
    */
    public function login(Request $request): JsonResponse
    {

        /*$verificacao = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);*/

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $request->user()->createToken('api-token')->plainTextToken;
            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Usuário com e-mail ou senha inválida'
            ], 404);
        }
    }
}
