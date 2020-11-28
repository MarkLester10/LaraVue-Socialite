<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin-email');
    }
}