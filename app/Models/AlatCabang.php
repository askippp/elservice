<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AlatCabang
 * 
 * @property int $id
 * @property int $id_alat
 * @property int $id_cabang
 *
 * @package App\Models
 */
class AlatCabang extends Model
{
	protected $table = 'alat_cabang';
	public $timestamps = false;

	protected $casts = [
		'id_alat' => 'int',
		'id_cabang' => 'int'
	];

	protected $fillable = [
		'id_alat',
		'id_cabang'
	];
}
