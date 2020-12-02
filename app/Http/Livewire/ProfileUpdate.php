<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProfileUpdate extends Component
{
    use WithFileUploads;

    public $userId;
    public $name;
    public $email;
    public $avatar;
    public $provider_id;


    public $prevName;
    public $prevEmail;
    public $prevAvatar;

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $model = User::find($this->userId);
        $this->name = $model->name;
        $this->email = $model->email;
        $this->avatar = $model->avatar;
        $this->provider_id = $model->provider_id;

        $this->prevName = $model->name;
        $this->prevEmail = $model->email;
        $this->prevAvatar = $model->avatar;
    }

    protected $rules = [
        'name' => 'required|max:20',
        'email' => 'required|email',
        'avatar' => 'mimes:jpeg,jpg,png,gif,svg|max:5242880'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateProfile()
    {
        $this->validate();
        $data = [];

        if ($this->name !== $this->prevName) {
            $data = array_merge($data, [
                'name' => $this->name
            ]);
        }
        if ($this->email !== $this->prevEmail) {
            $data = array_merge($data, [
                'email' => $this->email
            ]);
        }
        if ($this->avatar !== $this->prevAvatar) {

            Storage::delete('public/avatars/' . $this->prevAvatar);
            $avatarName = time() . '.' . $this->avatar->getClientOriginalName();
            $this->avatar->storeAs('public/avatars/', $avatarName);
            $data = array_merge($data, [
                'avatar' => $avatarName
            ]);
        }

        if (count($data)) {
            User::find($this->userId)->update($data);
            smilify('success', 'Profile Updated Successfully');
            return redirect()->route('user.profile');
        }
    }



    public function render()
    {
        return view('livewire.profile-update');
    }
}