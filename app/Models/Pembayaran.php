<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pembayaran
 * 
 * @property int $id
 * @property int $id_service
 * @property string $metode
 * @property string $status
 * @property string|null $midtrans_order_id
 * @property string|null $midtrans_transaction_id
 * @property string|null $midtrans_va_number
 * @property float $jumlah
 * @property Carbon $tanggal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 *
 * @package App\Models
 */
class Pembayaran extends Model
{
	protected $table = 'pembayaran';

	protected $casts = [
		'id_service' => 'int',
		'jumlah' => 'float',
		'tanggal' => 'datetime'
	];

	protected $fillable = [
		'id_service',
		'metode',
		'status',
		'midtrans_order_id',
		'midtrans_transaction_id',
		'midtrans_va_number',
		'jumlah',
		'tanggal'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}
}
