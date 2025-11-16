<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $id
 * @property int $id_user
 * @property string $nama
 * @property string $no_telp
 * @property string $alamat
 * @property string|null $provinsi
 * @property string|null $kota
 * @property string $email
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customer';

	protected $casts = [
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_user',
		'nama',
		'no_telp',
		'alamat',
		'provinsi',
		'kota',
		'email',
		'foto'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function services()
	{
		return $this->hasMany(Service::class, 'id_customer');
	}
}
