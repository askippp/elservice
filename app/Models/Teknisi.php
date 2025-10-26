<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Teknisi
 * 
 * @property int $id
 * @property string $email
 * @property string $no_telp
 * @property string $nama_lengkap
 * @property int $id_user
 * @property int $id_cabang
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cabang $cabang
 * @property User $user
 * @property Collection|DiagnosaService[] $diagnosa_services
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Teknisi extends Model
{
	protected $table = 'teknisi';

	protected $casts = [
		'id_user' => 'int',
		'id_cabang' => 'int'
	];

	protected $fillable = [
		'email',
		'no_telp',
		'nama_lengkap',
		'id_user',
		'id_cabang'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function diagnosa_services()
	{
		return $this->hasMany(DiagnosaService::class, 'id_teknisi');
	}

	public function services()
	{
		return $this->hasMany(Service::class, 'id_teknisi');
	}
}
