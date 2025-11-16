<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $hidden = [
        'password',
        'token'
    ];

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'token'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'id_user');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'id_user');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'id_user');
    }

    public function operators()
    {
        return $this->hasMany(Operator::class, 'id_user');
    }

    public function teknisis()
    {
        return $this->hasMany(Teknisi::class, 'id_user');
    }
}
