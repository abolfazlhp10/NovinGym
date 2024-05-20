<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminsController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required']
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            return response()->json(['message' => 'username or password is incorrect'], 401);
        } elseif (!password_verify($request->password, $admin->password)) {
            return response()->json(['message' => 'username or password is incorrect'], 401);
        }

        $AdminToken = $admin->createToken('adminToken', ['*'], now()->addMinutes(24 * 60));

        $AdminToken = $AdminToken->plainTextToken;

        return response()->json(['token' => $AdminToken]);
    }
}
