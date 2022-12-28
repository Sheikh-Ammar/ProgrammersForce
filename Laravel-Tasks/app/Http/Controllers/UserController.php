<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use App\Events\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('myToken')->plainTextToken;
        $userVerify =  UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        event(new RegisterUser($user, $userVerify));
        return response([
            'Message' => 'Email Verification Mail Send To Given Email',
        ]);
    }

    public function registerVerify($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                return redirect()->route('welcome')->with('status', 'Your E-mail is verified.');
            } else {
                return redirect()->route('welcome')->with('message', 'Your E-mail is already verified.');
            }
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                "Message" => "Provide Credentials Are Incorrect !",
            ], 401);
        }
        $token = $user->createToken('myToken')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'Message' => 'Successfully LogOut !',
            'Status' => 200,
        ]);
    }
}
