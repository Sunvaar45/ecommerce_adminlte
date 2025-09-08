<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account-info-edit', [

        ]);
    }

    public function update(Request $request)
    {
        // Validation and update logic here
        $admin = Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $admin->update($request->only([
            'name',
            'email',
        ]));

        if ($request->filled('password')) {
            if (!Hash::check($request->input('current_password'), $admin->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Mevcut şifre yanlış.']);
            }

            $admin->update([
                'password' => Hash::make($request->input('password')),
            ]);

            Auth::logout();
            return redirect()->route('admin.login')
                ->with('success', 'Şifreniz değiştirildi, lütfen tekrar giriş yapın.');
        }

        return redirect()->route('account.info.edit')
            ->with('success', 'Hesap bilgileri güncellendi.');
    }
}
