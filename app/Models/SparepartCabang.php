<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SparepartCabang
 * 
 * @property int $id
 * @property int $id_sparepart
 * @property int $id_cabang
 * 
 * @property Cabang $cabang
 * @property Sparepart $sparepart
 *
 * @package App\Models
 */
class SparepartCabang extends Model
{
	protected $table = 'sparepart_cabang';
	public $timestamps = false;

	protected $casts = [
		'id_sparepart' => 'int',
		'id_cabang' => 'int'
	];

	protected $fillable = [
		'id_sparepart',
		'id_cabang'
	];

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}

	public function sparepart()
	{
		return $this->belongsTo(Sparepart::class, 'id_sparepart');
	}
}
