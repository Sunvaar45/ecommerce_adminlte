<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // login attempt
        if (
            Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'status' => 1,
                'role' => [0, 1],
            ])
        ) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {

            // account status check
            if (
                $user->role == 2 &&
                Hash::check(
                    $request->password,
                    $user->password
                )
            ) {
                return back()->with(
                    'error',
                    'Bu bir müşteri hesabı. Lütfen yönetici hesabı ile giriş yapın.'
                )->onlyInput('email');
            }

            // role check
            if (
                $user->status == 0 &&
                Hash::check(
                    $request->password,
                    $user->password
                )
            ) {
                return back()->with(
                    'error',
                    'Hesabın dondurulmuş. Lütfen destek ile iletişime geç.'
                )->onlyInput('email');
            }
        }

        // wrong credentials
        return back()->with([
            'error' => 'Bu bilgilerle eşleşen bir hesap bulunamadı.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
