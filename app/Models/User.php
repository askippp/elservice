<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email_user
 * @property string $password
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Admin[] $admins
 * @property Collection|Operator[] $operators
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'user';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email_user',
		'password',
		'foto'
	];

	public function admins()
	{
		return $this->hasMany(Admin::class, 'id_user');
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
