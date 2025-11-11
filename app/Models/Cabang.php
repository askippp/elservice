<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cabang
 * 
 * @property int $id
 * @property string $nama_cabang
 * @property string $alamat
 * @property string $no_telp
 * @property string $status
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Alat[] $alats
 * @property Collection|Operator[] $operators
 * @property Collection|Pemasukan[] $pemasukans
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|Sparepart[] $spareparts
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
class Cabang extends Model
{
	protected $table = 'cabang';

	protected $fillable = [
		'nama_cabang',
		'alamat',
		'no_telp',
		'status',
		'foto'
	];

	public function alats()
	{
		return $this->belongsToMany(Alat::class, 'alat_cabang', 'id_cabang', 'id_alat')
					->withPivot('id', 'ketersediaan')
					->withTimestamps();
	}

	public function operators()
	{
		return $this->hasMany(Operator::class, 'id_cabang');
	}

	public function pemasukans()
	{
		return $this->hasMany(Pemasukan::class, 'id_cabang');
	}

	public function pengeluarans()
	{
		return $this->hasMany(Pengeluaran::class, 'id_cabang');
	}

	public function spareparts()
	{
		return $this->belongsToMany(Sparepart::class, 'sparepart_cabang', 'id_cabang', 'id_sparepart')
					->withPivot('id', 'stok')
					->withTimestamps();
	}

	public function teknisis()
	{
		return $this->hasMany(Teknisi::class, 'id_cabang');
	}
}
