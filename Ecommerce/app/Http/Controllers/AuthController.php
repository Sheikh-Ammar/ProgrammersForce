<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER USER
    public function register(AuthRequest $request)
    {
        $validateData = $request->validated();
        $user = User::create($validateData);
        $token = $user->createToken('authToken')->accessToken;
        return response()->json([
            'message' => 'User Register Successfully !',
        ], 200);
    }

    // VERIFY USER EMAIL
    public function email_verify()
    {
    }

    // LOGIN USER
    public function login(AuthRequest $request)
    {
        $validateData = $request->safe()->only(['email', 'password']);
        $user = User::where('email', $validateData['email'])->first();
        if (!$user || !Hash::check($validateData['password'], $user->password)) {
            return response([
                "Message" => "Provide Credentials Are Incorrect !",
            ], 401);
        }
        $token = $user->createToken('authToken')->accessToken;
        return response([
            'message' => 'User Login Successfully !',
            'token' => $token,
        ], 200);
    }

    // LOGOUT USER
    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response([
            'message' => 'User Logout Successfully !',
        ], 200);
    }
}
