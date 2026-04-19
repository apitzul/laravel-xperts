<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

   public function login(Request $request)
{
    if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}

public function apiLogin(Request $request)
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
}
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        }

        return redirect()->route('admin.login');
    }
}
