<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
}
