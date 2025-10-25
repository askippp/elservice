<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiagnosaService
 * 
 * @property int $id
 * @property int $id_service
 * @property string $diagnosa
 * @property Carbon $estimasi_waktu
 * @property int $estimasi_biaya
 * @property int $id_teknisi
 * @property Carbon $tgl_diagnosa
 *
 * @package App\Models
 */
class DiagnosaService extends Model
{
	protected $table = 'diagnosa_service';
	public $timestamps = false;

	protected $casts = [
		'id_service' => 'int',
		'estimasi_waktu' => 'datetime',
		'estimasi_biaya' => 'int',
		'id_teknisi' => 'int',
		'tgl_diagnosa' => 'datetime'
	];

	protected $fillable = [
		'id_service',
		'diagnosa',
		'estimasi_waktu',
		'estimasi_biaya',
		'id_teknisi',
		'tgl_diagnosa'
	];
}
