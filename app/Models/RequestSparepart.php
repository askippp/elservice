<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RequestSparepart
 * 
 * @property int $id
 * @property int $id_teknisi
 * @property int|null $id_operator
 * @property int $id_sparepart
 * @property int $jumlah
 * @property string $status
 * @property string|null $catatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Operator|null $operator
 * @property Sparepart $sparepart
 * @property Teknisi $teknisi
 *
 * @package App\Models
 */
class RequestSparepart extends Model
{
	protected $table = 'request_sparepart';

	protected $casts = [
		'id_teknisi' => 'int',
		'id_operator' => 'int',
		'id_sparepart' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'id_teknisi',
		'id_operator',
		'id_sparepart',
		'jumlah',
		'status',
		'catatan'
	];

	public function operator()
	{
		return $this->belongsTo(Operator::class, 'id_operator');
	}

	public function sparepart()
	{
		return $this->belongsTo(Sparepart::class, 'id_sparepart');
	}

	public function teknisi()
	{
		return $this->belongsTo(Teknisi::class, 'id_teknisi');
	}
}
