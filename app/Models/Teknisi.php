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
 * @property int $id_user
 * @property int $id_cabang
 * @property string $nama
 * @property string $spesialisasi
 * @property string $no_telp
 * @property string $alamat
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cabang $cabang
 * @property User $user
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|RequestSparepart[] $request_spareparts
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
		'id_user',
		'id_cabang',
		'email',
		'nama',
		'spesialisasi',
		'no_telp',
		'alamat',
		'foto'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function pengeluarans()
	{
		return $this->hasMany(Pengeluaran::class, 'id_teknisi');
	}

	public function request_spareparts()
	{
		return $this->hasMany(RequestSparepart::class, 'id_teknisi');
	}

	public function services()
	{
		return $this->hasMany(Service::class, 'id_teknisi');
	}
}
