<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AlatCabang
 * 
 * @property int $id
 * @property int $id_alat
 * @property int $id_cabang
 * @property string $ketersediaan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Alat $alat
 * @property Cabang $cabang
 *
 * @package App\Models
 */
class AlatCabang extends Model
{
	protected $table = 'alat_cabang';

	protected $casts = [
		'id_alat' => 'int',
		'id_cabang' => 'int'
	];

	protected $fillable = [
		'id_alat',
		'id_cabang',
		'ketersediaan'
	];

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'id_alat');
	}

	public function cabang()
	{
		return $this->belongsTo(Cabang::class, 'id_cabang');
	}
}
