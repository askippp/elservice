<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceSparepart
 * 
 * @property int $id
 * @property int $id_service
 * @property int $id_sparepart
 * @property int $jumlah
 * @property float $harga_satuan
 * @property float $subtotal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 * @property Sparepart $sparepart
 *
 * @package App\Models
 */
class ServiceSparepart extends Model
{
	protected $table = 'service_sparepart';

	protected $casts = [
		'id_service' => 'int',
		'id_sparepart' => 'int',
		'jumlah' => 'int',
		'harga_satuan' => 'float',
		'subtotal' => 'float'
	];

	protected $fillable = [
		'id_service',
		'id_sparepart',
		'jumlah',
		'harga_satuan',
		'subtotal'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}

	public function sparepart()
	{
		return $this->belongsTo(Sparepart::class, 'id_sparepart');
	}
}
