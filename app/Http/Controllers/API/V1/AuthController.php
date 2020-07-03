<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->except(['login','register']);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {

            return response()->json(['error' => 'Unauthorized'], 401);

        }

        return $this->respondWithToken($token);
    }


    public function register(RegisterRequest $request)
    {
    	\App\Model\User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => $request->password,
    	]);

    	return $this->login($request);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user'  => auth('api')->user()->name,
        ]);
    }
}
