<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|Cabang[] $cabangs
 * @property Collection|Service[] $services
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

	public function pengeluarans()
	{
		return $this->hasMany(Pengeluaran::class, 'id_sparepart');
	}

	public function cabangs()
	{
		return $this->belongsToMany(Cabang::class, 'sparepart_cabang', 'id_sparepart', 'id_cabang')
					->withPivot('id');
	}

	public function services()
	{
		return $this->belongsToMany(Service::class, 'sparepart_service', 'id_sparepart', 'id_service')
					->withPivot('id', 'jumlah', 'subtotal');
	}
}
