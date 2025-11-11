<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alat
 * 
 * @property int $id
 * @property int $id_kategori
 * @property int $id_merek
 * @property string $nama_alat
 * @property string $tipe_model
 * @property string|null $deskripsi
 * @property string|null $foto
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kategori $kategori
 * @property Merek $merek
 * @property Collection|Cabang[] $cabangs
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Alat extends Model
{
	protected $table = 'alat';

	protected $casts = [
		'id_kategori' => 'int',
		'id_merek' => 'int'
	];

	protected $fillable = [
		'id_kategori',
		'id_merek',
		'nama_alat',
		'tipe_model',
		'deskripsi',
		'foto',
		'status'
	];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'id_kategori');
	}

	public function merek()
	{
		return $this->belongsTo(Merek::class, 'id_merek');
	}

	public function cabangs()
	{
		return $this->belongsToMany(Cabang::class, 'alat_cabang', 'id_alat', 'id_cabang')
					->withPivot('id', 'ketersediaan')
					->withTimestamps();
	}

	public function services()
	{
		return $this->hasMany(Service::class, 'id_alat');
	}
}
