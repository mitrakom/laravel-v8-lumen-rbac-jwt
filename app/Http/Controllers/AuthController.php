<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'  
        ]);

        // Desc for field password confirmation
            // "password": "123456789",
            // "password_confirmation": "123456789"


        if ($validatedData->fails()) {
            return response()->json([
                // 'message' => 'Invalid data',
                // 'data' => $validatedData->messages(),
                'message' => $validatedData->messages()->first()
            ], 201);
        }


        // $validatedData['password'] = Hash::make($request->password);
        
        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ];

        // return $data;

        
        $register = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'Register Success',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Fails',
                'data' => ''
            ], 400);
        }
        
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    
}
