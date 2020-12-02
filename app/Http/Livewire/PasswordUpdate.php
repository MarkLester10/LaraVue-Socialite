<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class PasswordUpdate extends Component
{
    public $current_hashed_password;
    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;

    public function mount()
    {
        $model = User::find(auth()->user()->id);
        $this->current_hashed_password = $model->password;
    }


    public function updatePassword()
    {
        $data = [];

        if (auth()->user()->password) {
            $this->validate([
                'newPassword' => ['required', 'string', 'max:16', 'confirmed'],
                'currentPassword' => ['required', 'checkCurrentPasswordHashed:' . $this->current_hashed_password],
            ]);
        }

        $this->validate([
            'newPassword' => ['required', 'string', 'max:16', 'confirmed'],
        ]);


        $data = array_merge($data, [
            'password' => Hash::make($this->newPassword)
        ]);

        if (count($data)) {
            User::find(auth()->user()->id)->update($data);
            smilify('success', 'Password Updated Successfully');
            return redirect()->route('user.profile');
        }
    }

    public function render()
    {
        return view('livewire.password-update');
    }
}