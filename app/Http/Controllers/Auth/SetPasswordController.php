<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePasswordRequest;

class SetPasswordController extends Controller
{
    public function create()
    {
        return view('auth.passwords.setpassword');
    }

    public function store(StorePasswordRequest $request)
    {
        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        smilify('success', 'Welcome to the club!');

        return redirect()->route('admin.dashboard');
    }
}