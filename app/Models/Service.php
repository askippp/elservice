<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property int $id_customer
 * @property int $id_cabang
 * @property int $id_operator
 * @property string|null $alamat_service
 * @property string $keluhan
 * @property string|null $diagnosa
 * @property float|null $biaya_service
 * @property float|null $biaya_kunjungan
 * @property float|null $total_biaya
 * @property string $status
 * @property Carbon $tanggal_masuk
 * @property Carbon|null $tanggal_selesai
 * @property string|null $catatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cabang $cabang
 * @property Customer $customer
 * @property Operator $operator
 * @property Collection|Pemasukan[] $pemasukans
 * @property Collection|Pembayaran[] $pembayarans
 * @property Collection|Alat[] $alats
 * @property Collection|Sparepart[] $spareparts
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'service';

	protected $casts = [
		'id_customer' => 'int',
		'id_cabang' => 'int',
		'id_operator' => 'int',
		'biaya_service' => 'float',
		'biaya_kunjungan' => 'float',
		'total_biaya' => 'float',
		'tanggal_masuk' => 'datetime',
		'tanggal_selesai' => 'datetime'
	];

	protected $fillable = [
		'id_customer',
		'id_cabang',
		'id_operator',
		'alamat_service',
		'keluhan',
		'diagnosa',
		'biaya_service',
		'biaya_kunjungan',
		'total_biaya',
		'status',
		'tanggal_masuk',
		'tanggal_selesai',
		'catatan'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'id_customer');
	}

	public function operator()
	{
		return $this->belongsTo(Operator::class, 'id_operator');
	}

	public function pemasukans()
	{
		return $this->hasMany(Pemasukan::class, 'id_service');
	}

	public function pembayarans()
	{
		return $this->hasMany(Pembayaran::class, 'id_service');
	}

	public function alats()
	{
		return $this->belongsToMany(Alat::class, 'service_alat', 'id_service', 'id_alat')
					->withPivot('id')
					->withTimestamps();
	}

	public function spareparts()
	{
		return $this->belongsToMany(Sparepart::class, 'service_sparepart', 'id_service', 'id_sparepart')
					->withPivot('id', 'jumlah', 'harga_satuan', 'subtotal')
					->withTimestamps();
	}

	public function teknisis()
	{
		return $this->belongsToMany(Teknisi::class, 'service_teknisi', 'id_service', 'id_teknisi')
					->withPivot('id')
					->withTimestamps();
	}
}
