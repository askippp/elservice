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
 * @property int $id_cabang
 * @property Carbon $tgl_service
 * @property string $keluhan
 * @property string $status
 * @property Carbon|null $tgl_selesai
 * @property string|null $keterangan
 * @property int|null $total_harga
 * @property string $status_bayar
 * @property string|null $tipe_pembayaran
 * 
 * @property Alat $alat
 * @property Cabang $cabang
 * @property Customer $customer
 * @property Operator $operator
 * @property Teknisi $teknisi
 * @property Collection|Pemasukan[] $pemasukans
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|Sparepart[] $spareparts
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'service';
	public $timestamps = false;

	protected $casts = [
		'id_customer' => 'int',
		'id_operator' => 'int',
		'id_teknisi' => 'int',
		'id_alat' => 'int',
		'id_cabang' => 'int',
		'tgl_service' => 'datetime',
		'tgl_selesai' => 'datetime',
		'total_harga' => 'int'
	];

	protected $fillable = [
		'id_customer',
		'id_operator',
		'id_teknisi',
		'id_alat',
		'id_cabang',
		'tgl_service',
		'keluhan',
		'status',
		'tgl_selesai',
		'keterangan',
		'total_harga',
		'status_bayar',
		'tipe_pembayaran'
	];

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'id_alat');
	}

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

	public function teknisi()
	{
		return $this->belongsTo(Teknisi::class, 'id_teknisi');
	}

	public function pemasukans()
	{
		return $this->hasMany(Pemasukan::class, 'id_service');
	}

	public function pengeluarans()
	{
		return $this->hasMany(Pengeluaran::class, 'id_service');
	}

	public function spareparts()
	{
		return $this->belongsToMany(Sparepart::class, 'sparepart_service', 'id_service', 'id_sparepart')
					->withPivot('id', 'jumlah', 'subtotal');
	}
}
