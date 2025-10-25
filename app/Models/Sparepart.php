<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sparepart
 * 
 * @property int $id
 * @property int $id_kategori
 * @property int $id_merek
 * @property string $nama_sparepart
 * @property string $satuan
 * @property int $harga_beli
 * @property int $harga_jual
 * @property int $stok
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kategori $kategori
 * @property Merek $merek
 *
 * @package App\Models
 */
class Sparepart extends Model
{
	protected $table = 'sparepart';

	protected $casts = [
		'id_kategori' => 'int',
		'id_merek' => 'int',
		'harga_beli' => 'int',
		'harga_jual' => 'int',
		'stok' => 'int'
	];

	protected $fillable = [
		'id_kategori',
		'id_merek',
		'nama_sparepart',
		'satuan',
		'harga_beli',
		'harga_jual',
		'stok',
		'foto'
	];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'id_kategori');
	}

	public function merek()
	{
		return $this->belongsTo(Merek::class, 'id_merek');
	}
}
