<?php

namespace App\Models\User;

use Rackbeat\UIAvatars\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar($size = 64)
    {
        return $this->getGravatar($this->name, $size);
    }

    public function avatar()
    {
        $avatar = '';
        $imageExists = Storage::disk('local')->exists('public/avatars/' . $this->avatar);
        if (!$imageExists && $this->provider_id) {
            $avatar = $this->avatar;
        } elseif ($imageExists && $this->avatar) {
            $avatar = asset('storage/avatars/' . $this->avatar);
        } else {
            $avatar = $this->getUrlfriendlyAvatar();
        }

        return $avatar;
    }
}