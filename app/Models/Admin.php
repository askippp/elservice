<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string $email
 * @property string $no_telp
 * @property string $nama_lengkap
 * @property int $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admin';

	protected $casts = [
		'id_user' => 'int'
	];

	protected $fillable = [
		'email',
		'no_telp',
		'nama_lengkap',
		'id_user'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
