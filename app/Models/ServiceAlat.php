<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceAlat
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_alat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Alat $alat
 * @property Service $service
 *
 * @package App\Models
 */
class ServiceAlat extends Model
{
	protected $table = 'service_alat';

	protected $casts = [
		'id_service' => 'int',
		'id_alat' => 'int'
	];

	protected $fillable = [
		'id_service',
		'id_alat'
	];

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'id_alat');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}
}
