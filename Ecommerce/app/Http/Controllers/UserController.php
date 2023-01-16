<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // SHOW ALL USERS
    public function index()
    {
        $user = User::paginate(10);
        return response()->json([
            'user' => $user,
        ]);
    }

    // SHOW SPECIFIC USER
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->get();
            return response()->json([
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id user not found',
            ], 404);
        }
    }

    // ADD USER DATA
    public function store(UserRequest $request)
    {
        $validateData = $request->validated();
        User::create($validateData);
        return response()->json([
            'message' => 'User Created Successfully !',
        ]);
    }

    // UPDATE USER DATA
    public function update(UserRequest $request, $id)
    {
        $validateData = $request->validated();
        $user = User::find($id);
        if ($user) {
            $user->update($validateData);
            return response()->json([
                'message' => 'User Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id user not found',
            ], 404);
        }
    }

    // DELETE USER DATA
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->delete();
        return response()->json([
            'message' => 'Contact Deleted',
        ], 200);
    }
}
