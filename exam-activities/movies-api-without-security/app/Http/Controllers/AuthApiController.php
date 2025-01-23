<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/register",
     *   summary="Register a new user",
     *   description="Registers a new user and returns the JWT token for authentication",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *       required=true,
     *       description="User registration data",
     *       @OA\JsonContent(
     *           type="object",
     *           required={"name", "email", "password"},
     *           @OA\Property(property="name", type="string", description="User's name"),
     *           @OA\Property(property="email", type="string", description="User's email"),
     *           @OA\Property(property="password", type="string", description="User's password")
     *       )
     *   ),
     *   @OA\Response(
     *       response=201,
     *       description="User successfully registered and JWT token returned",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="token", type="string", description="JWT token for authentication")
     *       )
     *   ),
     *   @OA\Response(
     *       response=400,
     *       description="Invalid request data"
     *   )
     * )
     */
    public function register(Request $request)   {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user', 
        ]);
        return auth('api')->login($user);
    }

    
    /**
     * @OA\Post(
     *   path="/api/login",
     *   summary="Login user and get JWT token",
     *   description="Logs in the user and returns a JWT token for authentication",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *       required=true,
     *       description="User login credentials",
     *       @OA\JsonContent(
     *           type="object",
     *           required={"name", "password"},
     *           @OA\Property(property="name", type="string", description="User's name"),
     *           @OA\Property(property="password", type="string", description="User's password")
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="JWT token returned successfully",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="token", type="string", description="JWT token for authentication")
     *       )
     *   ),
     *   @OA\Response(
     *       response=401,
     *       description="Unauthorized access, invalid credentials"
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="User not found"
     *   )
     * )
     */
    public function login(Request $request) {
        $nom = $request->input('name');
        $pass = $request->input('password');
        $user = User::where('name', '=', $nom)->first();

        if(isset($user) ){
            $usuarioname = $user['name'];
            $usuariohashpass = $user['password'];
            if (Hash::check($pass, $usuariohashpass )) {
                $token = JWTAuth::fromUser($user);
                return $token;
            } else {
                
                return response()->json(['error' => 'Unauthorized', $nom => $pass], 401);
            }
        } else {
            return response()->json(['error' => 'User not found', $nom => $pass], 401);
        }
    }
}
