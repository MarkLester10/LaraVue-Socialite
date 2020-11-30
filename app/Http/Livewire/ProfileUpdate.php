<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User\User;

class ProfileUpdate extends Component
{
    public $userId;
    public $name;
    public $email;

    public $prevName;
    public $prevEmail;

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $model = User::find($this->userId);
        $this->name = $model->name;
        $this->email = $model->email;

        $this->prevName = $model->name;
        $this->prevEmail = $model->email;
    }

    protected $rules = [
        'name' => 'required|max:20',
        'email' => 'required|email',
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