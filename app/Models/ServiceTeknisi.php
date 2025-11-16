<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceTeknisi
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_teknisi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 * @property Teknisi $teknisi
 *
 * @package App\Models
 */
class ServiceTeknisi extends Model
{
	protected $table = 'service_teknisi';

	protected $casts = [
		'id_service' => 'int',
		'id_teknisi' => 'int'
	];

	protected $fillable = [
		'id_service',
		'id_teknisi'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}

	public function teknisi()
	{
		return $this->belongsTo(Teknisi::class, 'id_teknisi');
	}
}
