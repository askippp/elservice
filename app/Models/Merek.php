<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Merek
 * 
 * @property int $id
 * @property string $nama_merek
 * 
 * @property Collection|Alat[] $alats
 * @property Collection|Sparepart[] $spareparts
 *
 * @package App\Models
 */
class Merek extends Model
{
	protected $table = 'merek';
	public $timestamps = false;

	protected $fillable = [
		'nama_merek'
	];

	public function alats()
	{
		return $this->hasMany(Alat::class, 'id_merek');
	}

	public function spareparts()
	{
		return $this->hasMany(Sparepart::class, 'id_merek');
	}
}
