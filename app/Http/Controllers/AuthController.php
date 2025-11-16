<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Operator;
use App\Models\Teknisi;
use App\Models\Customer;
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
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'User tidak ditemukan'], 401);
        }

        $role = $user->role ?? 'user';
        $detail = null;

        // check if the user has a related admin/operator/teknisi/customer record
        if (Admin::where('id_user', $user->id)->exists()) {
            $role = 'admin';
            $detail = Admin::where('id_user', $user->id)->first();
        } elseif (Operator::where('id_user', $user->id)->exists()) {
            $role = 'operator';
            $detail = Operator::where('id_user', $user->id)->first();
        } elseif (Teknisi::where('id_user', $user->id)->exists()) {
            $role = 'teknisi';
            $detail = Teknisi::where('id_user', $user->id)->first();
        } elseif (Customer::where('id_user', $user->id)->exists()) {
            $role = 'customer';
            $detail = Customer::where('id_user', $user->id)->first();
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

    public function register(Request $request) 
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|integer|unique:customer,no_telp',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:10',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $users = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        $customer = Customer::create([
            'id_user' => $users->id,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $users,
            'customer' => $customer,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
