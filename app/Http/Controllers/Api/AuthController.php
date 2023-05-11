<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:api', ['except' => 'login']);
    }

    public function login(AuthLoginRequest $request) {
        $credentials = $request->validated();
        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'error' => true,
                'message' => 'Email or password do not match'
            ], 401);
        } else {
            return response()->json([
                'error' => false,
                'data' => [
                    'access_token' => $token,
                    'type' => 'Bearer',
                    'expires_in' => env('JWT_TTL')
                ]
            ]);
        }
    }

    public function logout() {
        auth('api')->logout();

        return response()->json([
            'error' => false,
            'message' => 'berhasil logout'
        ]);
    }
}
