<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\VerifyEmailEvent;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // REGISTER USER
    public function register(AuthRequest $request)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['remember_token' =>  Str::random(30)]);
        $user = User::create($data);
        $token = $user->createToken('authToken')->accessToken;
        event(new VerifyEmailEvent($user));
        return response()->json([
            'message' => 'User Register Successfully !',
            'alert' => 'Please Check Your Mail For Your Email Verification',
        ], 200);
    }

    // VERIFY USER EMAIL
    public function emailVerify($token)
    {
        $user = User::where('remember_token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if (!is_null($user)) {
            if (!$user->email_verified) {
                $user->email_verified = 1;
                $user->email_verified_at = now();
                $user->save();
                return redirect()->route('welcome')->with('status', 'Your E-mail is verified.');
            } else {
                return redirect()->route('welcome')->with('message', 'Your E-mail is already verified.');
            }
        } else {
            return redirect()->route('non-verify');
        }
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

    // RESET PASSWORD
    public  function resetPassword(Request $request)
    {
        $data = $request->validate([
            'new_password' => 'min:5',
            'new_confirm_passsword' => 'required_with:new_password|same:new_password|min:5',
        ]);
        if (Auth::check()) {
            $user = Auth::user();
            $user->password = $request->new_password;
            $user->save;
            return response([
                'message' => 'Your Password Updated Successfully !',
            ], 200);
        }
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
