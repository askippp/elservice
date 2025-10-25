<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $nama_customer
 * @property string $email
 * @property int $no_telp
 * @property string $alamat
 * @property int $id_operator
 * @property int $id_cabang
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customer';

	protected $casts = [
		'no_telp' => 'int',
		'id_operator' => 'int',
		'id_cabang' => 'int'
	];

	protected $fillable = [
		'nama_customer',
		'email',
		'no_telp',
		'alamat',
		'id_operator',
		'id_cabang'
	];
}
