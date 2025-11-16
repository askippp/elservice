<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Operator;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $query = User::query();
        if ($role) {
            $query->where('role', $role);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'    => 'required|string|unique:users,username',
            'password'    => 'required|string|min:6',
            'operator_id' => 'nullable|integer|exists:operator,id',
            'teknisi_id'  => 'nullable|integer|exists:teknisi,id',
        ]);

        $isOperator = !empty($validated['operator_id']);
        $isTeknisi  = !empty($validated['teknisi_id']);

        if (($isOperator && $isTeknisi) || (!$isOperator && !$isTeknisi)) {
            abort(422, 'Pilih salah satu: operator_id atau teknisi_id.');
        }

        $model = $isOperator ? Operator::class : Teknisi::class;
        $entity = $model::findOrFail($isOperator ? $validated['operator_id'] : $validated['teknisi_id']);
        $role   = $isOperator ? 'operator' : 'teknisi';

        if ($entity->id_user !== null) {
            abort(422, ucfirst($role) . ' ini sudah memiliki akun.');
        }

        if (empty($entity->email)) {
            abort(422, 'Email pada profil ' . $role . ' belum diisi.');
        }

        if (User::where('email', $entity->email)->exists()) {
            abort(422, 'Email tersebut sudah digunakan.');
        }

        return DB::transaction(function () use ($validated, $entity, $role) {

            $user = User::create([
                'username' => $validated['username'],
                'email'    => $entity->email,
                'password' => Hash::make($validated['password']),
                'role'     => $role,
            ]);

            $entity->update(['id_user' => $user->id]);

            return response()->json([
                'user' => $user,
                $role  => $entity->fresh(),
            ], 201);
        });
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['sometimes', 'required', 'string', Rule::unique('users', 'username')->ignore($user->id)],
            'password' => ['sometimes', 'required', 'string', 'min:6'],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user->fresh(), 200);
    }

    public function destroy(User $user)
    {
        return DB::transaction(function () use ($user) {

            Operator::where('id_user', $user->id)->update(['id_user' => null]);
            Teknisi::where('id_user', $user->id)->update(['id_user' => null]);

            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully',
            ], 200);
        });
    }

    public function show(Request $request)
    {
        return $request->user();
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'username' => ['sometimes','string', Rule::unique('users','username')->ignore($user->id)],
            'email'    => ['sometimes','email', Rule::unique('users','email')->ignore($user->id)],
            'old_password' => ['sometimes','string'],
            'new_password' => ['sometimes','string','min:6'],
            'confirm_password' => ['sometimes','string','same:new_password'],
        ]);

        // Jika ingin ubah password, wajib cek old_password benar
        if ($request->filled('new_password')) {
            if (!$request->filled('old_password') || !Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => 'Password lama tidak sesuai',
                ], 422);
            }
        }

        $update = [];
        if ($request->filled('username')) {
            $update['username'] = $validated['username'];
        }
        if ($request->filled('email')) {
            $update['email'] = $validated['email'];
        }
        if ($request->filled('new_password')) {
            $update['password'] = Hash::make($validated['new_password']);
        }

        if (!empty($update)) {
            $user->update($update);
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user->fresh(),
        ], 200);
    }
}
