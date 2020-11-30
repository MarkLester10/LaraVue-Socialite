<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Notifications\AdminInviteNotification;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admins = Admin::where('role_id', 2)->get();
        return view('admin.users', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        /* If you want to add more fields, make sure to include them in the fillable field
            validated method is used for security measures, to only accept variables that comes after validation

        **/
        $user = Admin::create($request->validated()
            + ['password' => 'secret', 'role_id' => 2]);

        $url = URL::signedRoute('invitation', $user);

        $user->notify(new AdminInviteNotification($url));

        notify()->success('Invitation has been sent to user ⚡️', 'Admin User Created');
        return redirect()->route('users.index');
    }

    public function invitation($id)
    {
        $admin = Admin::where('id', $id)->first();
        if (!request()->hasValidSignature() || $admin->password != 'secret') {
            abort(401);
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::where('id', $id)->first();
        return view('admin.edit', ['admin' => $admin]);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::where('id', $id)->first();
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin)],
        ]);
        $admin->update($data);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->delete();
        return back();
    }
}