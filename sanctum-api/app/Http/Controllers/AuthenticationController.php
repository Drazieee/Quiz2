<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'address' => 'required',
            'account_type' => 'required',
            'password' => 'required|min:6|confirmed',
        ],
        [
            'email.unique' => 'The email has already been taken.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'account_type' => $request->account_type,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ],
        [
            'exists.exists' => "The email wasn't registered.",
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user_id' => $user->id, 'account_type' => $user->account_type], 201);
        }

        return response()->json(['message' => 'Invalid username or password'], 401);
    }
}
