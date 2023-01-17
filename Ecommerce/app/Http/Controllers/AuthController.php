<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\VerifyEmailEvent;
use App\Http\Requests\AuthRequest;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // REGISTER USER
    public function register(AuthRequest $request)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['remember_token' =>  Str::random(50)]);
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
                return redirect()->route('welcome')->with('status', 'Thanks To Verify Your Email');
            } else {
                return redirect()->route('welcome')->with('status', 'You Already Verify Your Email');
            }
        } else {
            return redirect()->route('non-verify')->with('status', 'Please Verify Your Email');
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

    // RESET PASSWORD ONLY WHEN USER IS AUTHENTICATED
    public  function resetPassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);
        if (Auth::check()) {
            $user = Auth::user();
            $user->password = $request->password;
            $user->save;
            return response([
                'message' => 'Your Password Updated Successfully !',
            ], 200);
        }
    }

    // FORGET PASSWORD
    public function forgetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(50);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);
        Mail::to($request->email)->send(new ForgetPasswordMail($token));
        return response([
            'message' => 'Please Check Your Email For Reset Your Password',
        ], 200);
    }

    // RESET PASSWORD FOR FORGET PASSWORD USERS
    public function resetForgetPassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $token])->first();
        if (!$updatePassword) {
            return redirect()->route('login');
        }
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->where('token', $token)->delete();
        return response([
            'message' => 'Your Password reset Successfully !',
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
