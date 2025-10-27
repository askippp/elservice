<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Operator;
use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //cek email di table user
        $user = User::where('email_user', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'User tidak ditemukan'], 401);
        }

        $role = null;
        $detail = null;

        //cek email di table admin
        if (Admin::where('email', $request->email)->exists()) {
            $role = 'admin';
            $detail = Admin::where('email', $request->email)->first();
        } elseif (Operator::where('email', $request->email)->exists()) {
            //cek email di table operator
            $role = 'operator';
            $detail = Operator::where('email', $request->email)->first();
        } elseif(Teknisi::where('email', $request->email)->exists()){
            //cek email di table teknisi
            $role = 'teknisi';
            $detail = Teknisi::where('email', $request->email)->first();
        } else {
            //jika bukan admin atau operator, maka role adalah user biasa
            $role = 'unknown';
            $detail = null;
        }

        // Generate a new token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login sukses',
            'token' => $token,
            'user' => $user,
            'role' => $role,
            'detail' => $detail,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
