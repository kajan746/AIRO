<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\RequestHandlers\LoginRequestHandler;
use App\Http\RequestHandlers\CreateUserRequestHandler;

class AuthController extends Controller
{
    public function register(CreateUserRequestHandler $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('api')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token
            ]
        ], 201);
    }

    public function getRegistrationPage()
    {
        return View::make('auth.register');
    }

    public function login(LoginRequestHandler $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => 'Successfully logged into the system',
            'user' => $user,
            'authorisation' => [
                'token' => $token
            ]
        ], 200);
    }

    public function getLoginPage()
    {
        return View::make('auth.login');
    }


    public function userProfile()
    {
        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => 'success',
            'message' => 'User Details',
            'user' => $user
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out from the system.',
        ], 200);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
            'authorisation' => [
                'token' => Auth::refresh()
            ]
        ], 200);
    }
}
