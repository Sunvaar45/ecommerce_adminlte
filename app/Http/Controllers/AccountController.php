<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account-info-edit', [

        ]);
    }

    public function update(Request $request)
    {
        
    }
}
