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
 * @property int $id_operator
 * @property int $id_teknisi
 * @property int $id_alat
 * @property string $jenis_service
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
 * @property Alat $alat
 * @property Customer $customer
 * @property Operator $operator
 * @property Teknisi $teknisi
 * @property Collection|Pemasukan[] $pemasukans
 * @property Collection|Pembayaran[] $pembayarans
 * @property Collection|Sparepart[] $spareparts
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'service';

	protected $casts = [
		'id_customer' => 'int',
		'id_operator' => 'int',
		'id_teknisi' => 'int',
		'id_alat' => 'int',
		'biaya_service' => 'float',
		'biaya_kunjungan' => 'float',
		'total_biaya' => 'float',
		'tanggal_masuk' => 'datetime',
		'tanggal_selesai' => 'datetime'
	];

	protected $fillable = [
		'id_customer',
		'id_operator',
		'id_teknisi',
		'id_alat',
		'jenis_service',
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

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'id_alat');
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'id_customer');
	}

	public function operator()
	{
		return $this->belongsTo(Operator::class, 'id_operator');
	}

	public function teknisi()
	{
		return $this->belongsTo(Teknisi::class, 'id_teknisi');
	}

	public function pemasukans()
	{
		return $this->hasMany(Pemasukan::class, 'id_service');
	}

	public function pembayarans()
	{
		return $this->hasMany(Pembayaran::class, 'id_service');
	}

	public function spareparts()
	{
		return $this->belongsToMany(Sparepart::class, 'service_sparepart', 'id_service', 'id_sparepart')
					->withPivot('id', 'jumlah', 'harga_satuan', 'subtotal')
					->withTimestamps();
	}
}
