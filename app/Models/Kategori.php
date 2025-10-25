<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kategori
 * 
 * @property int $id
 * @property string $nama_kategori
 * 
 * @property Collection|Alat[] $alats
 * @property Collection|Sparepart[] $spareparts
 *
 * @package App\Models
 */
class Kategori extends Model
{
	protected $table = 'kategori';
	public $timestamps = false;

	protected $fillable = [
		'nama_kategori'
	];

	public function alats()
	{
		return $this->hasMany(Alat::class, 'id_kategori');
	}

	public function spareparts()
	{
		return $this->hasMany(Sparepart::class, 'id_kategori');
	}
}
