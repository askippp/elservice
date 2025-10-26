<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengeluaran
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_operator
 * @property int $id_cabang
 * @property int $id_sparepart
 * @property Carbon $tgl
 * @property string $jenis
 * @property string $keterangan
 * @property int $jumlah
 * 
 * @property Cabang $cabang
 * @property Operator $operator
 * @property Service $service
 * @property Sparepart $sparepart
 *
 * @package App\Models
 */
class Pengeluaran extends Model
{
	protected $table = 'pengeluaran';
	public $timestamps = false;

	protected $casts = [
		'id_service' => 'int',
		'id_operator' => 'int',
		'id_cabang' => 'int',
		'id_sparepart' => 'int',
		'tgl' => 'datetime',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'id_service',
		'id_operator',
		'id_cabang',
		'id_sparepart',
		'tgl',
		'jenis',
		'keterangan',
		'jumlah'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function operator()
	{
		return $this->belongsTo(Operator::class, 'id_operator');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}

	public function sparepart()
	{
		return $this->belongsTo(Sparepart::class, 'id_sparepart');
	}
}
