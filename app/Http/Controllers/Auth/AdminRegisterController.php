<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        return view('auth.admin-register');
    }

    protected function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $admin = Admin::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            //log in the newly created admin user
            // Auth::guard('admin')->loginUsingId($admin->id);

            return redirect()->route('admin.dashboard')->with('message', "You successfully new Admin User");
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }
}