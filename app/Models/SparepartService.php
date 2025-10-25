<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SparepartService
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_sparepart
 * @property int $jumlah
 * @property int $subtotal
 *
 * @package App\Models
 */
class SparepartService extends Model
{
	protected $table = 'sparepart_service';
	public $timestamps = false;

	protected $casts = [
		'id_service' => 'int',
		'id_sparepart' => 'int',
		'jumlah' => 'int',
		'subtotal' => 'int'
	];

	protected $fillable = [
		'id_service',
		'id_sparepart',
		'jumlah',
		'subtotal'
	];
}
