<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{
    public function confirmAccount($token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid token');
        }

        return view('auth.confirm-account', compact('user'));
    }

    public function confirmAccountSubmit()
    {
        $data = request()->validate([
            'token' => 'required|string|exists:users,confirmation_token',
            'password' => 'required|min:8|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        $user = User::where('confirmation_token', request('token'))->first();

        $user->update([
            'password' => bcrypt($data['password']),
            'confirmation_token' => null,
            'email_verified_at' => now(),
        ]);

        return view('auth.welcome', compact('user'));
    }
}
