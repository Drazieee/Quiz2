<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();

        return response($users, 200);
    }

    public function showUser($id)
    {
        $user = User::find($id);

        return response()->json($user, 200);
    }

    public function editUser(Request $request, $id)
    {
        $request->validate([
            'userName' => 'required',
            'fullName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'required',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'user_name' => $request->userName,
            'full_name' => $request->fullName,
            'email' => $request->email,
            'price' => $request->address,
        ]);

        return response()->json(['message' => 'Successfully Updated'], 200);
    }

    public function removeUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['Successfully Removed User'], 200);
    }
}
