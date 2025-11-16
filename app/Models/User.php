<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Admin[] $admins
 * @property Collection|Customer[] $customers
 * @property Collection|Log[] $logs
 * @property Collection|Operator[] $operators
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
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
