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
 * @property int $no_telp
 * @property string $alamat
 * @property string $kota
 * @property string $email
 * @property string|null $foto
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Alat[] $alats
 * @property Collection|Customer[] $customers
 * @property Collection|Operator[] $operators
 * @property Collection|Pemasukan[] $pemasukans
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|Service[] $services
 * @property Collection|Sparepart[] $spareparts
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
class Cabang extends Model
{
	protected $table = 'cabang';

	protected $casts = [
		'no_telp' => 'int'
	];

	protected $fillable = [
		'nama_cabang',
		'no_telp',
		'alamat',
		'kota',
		'email',
		'foto',
		'status'
	];

	public function alats()
	{
		return $this->belongsToMany(Alat::class, 'alat_cabang', 'id_cabang', 'id_alat')
					->withPivot('id');
	}

	public function customers()
	{
		return $this->hasMany(Customer::class, 'id_cabang');
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

	public function services()
	{
		return $this->hasMany(Service::class, 'id_cabang');
	}

	public function spareparts()
	{
		return $this->belongsToMany(Sparepart::class, 'sparepart_cabang', 'id_cabang', 'id_sparepart')
					->withPivot('id');
	}

	public function teknisis()
	{
		return $this->hasMany(Teknisi::class, 'id_cabang');
	}
}
