<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * 
 * @property int $id
 * @property int $id_user
 * @property string $aktivitas
 * @property Carbon $waktu
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Log extends Model
{
	protected $table = 'logs';
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int',
		'waktu' => 'datetime'
	];

	protected $fillable = [
		'id_user',
		'aktivitas',
		'waktu'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
