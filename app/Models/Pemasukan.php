<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pemasukan
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_cabang
 * @property Carbon $tgl
 * @property string $sumber
 * @property int $jumlah
 * 
 * @property Cabang $cabang
 * @property Service $service
 *
 * @package App\Models
 */
class Pemasukan extends Model
{
	protected $table = 'pemasukan';
	public $timestamps = false;

	protected $casts = [
		'id_service' => 'int',
		'id_cabang' => 'int',
		'tgl' => 'datetime',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'id_service',
		'id_cabang',
		'tgl',
		'sumber',
		'jumlah'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}
}
