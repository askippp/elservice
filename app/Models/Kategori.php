<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kategori
 * 
 * @property int $id
 * @property string $nama_kategori
 * @property string|null $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Alat[] $alats
 * @property Collection|Sparepart[] $spareparts
 *
 * @package App\Models
 */
class Kategori extends Model
{
	protected $table = 'kategori';

	protected $fillable = [
		'nama_kategori',
		'deskripsi'
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
