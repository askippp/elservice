<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Merek
 * 
 * @property int $id
 * @property string $nama_merek
 * @property string|null $negara_asal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Alat[] $alats
 *
 * @package App\Models
 */
class Merek extends Model
{
	protected $table = 'merek';

	protected $fillable = [
		'nama_merek',
		'negara_asal'
	];

	public function alats()
	{
		return $this->hasMany(Alat::class, 'id_merek');
	}
}
