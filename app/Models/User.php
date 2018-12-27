<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\DefaultResetPasswordNotification;


class User extends Authenticatable implements TableInterface
{
    use Notifiable;

    const ROLE_ADMIN=1;
    const ROLE_CLIENT=2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword($password=null)
    {
        return !$password ? bcrypt(str_random(8)):bcrypt($password);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DefaultResetPasswordNotification($token));
    }

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
    }

    public function getValueForHeader($header)
    {
        switch($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            CASE 'E-mail':
                return $this->email;
        }
    }

}
