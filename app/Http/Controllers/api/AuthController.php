<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'message' => 'Invalid login details',
                ],
                401,
            );
        }
        // dd($request->all());

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json($token, 200);

        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        // ]);
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        auth()
            ->user()
            ->tokens()
            ->delete();

        return response([
            'message' => 'log out successful ',
        ]);
    }
}
