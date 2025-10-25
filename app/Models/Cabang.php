<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cabang
 * 
 * @property int $id
 * @property string $nama_cabang
 * @property int $no_telp
 * @property string $alamat
 * @property string $kota
 * @property string $email
 * @property string|null $foto
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Operator[] $operators
 * @property Collection|Teknisi[] $teknisis
 *
 * @package App\Models
 */
class Cabang extends Model
{
	protected $table = 'cabang';

	protected $casts = [
		'no_telp' => 'int'
	];

	protected $fillable = [
		'nama_cabang',
		'no_telp',
		'alamat',
		'kota',
		'email',
		'foto',
		'status'
	];

	public function operators()
	{
		return $this->hasMany(Operator::class, 'id_cabang');
	}

	public function teknisis()
	{
		return $this->hasMany(Teknisi::class, 'id_cabang');
	}
}
