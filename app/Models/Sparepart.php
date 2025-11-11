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
 * @property string $nama_sparepart
 * @property string $merek
 * @property int $stok
 * @property float $harga_beli
 * @property float $harga_jual
 * @property string|null $deskripsi
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kategori $kategori
 * @property Collection|Pengeluaran[] $pengeluarans
 * @property Collection|RequestSparepart[] $request_spareparts
 * @property Collection|Service[] $services
 * @property Collection|Cabang[] $cabangs
 *
 * @package App\Models
 */
class Sparepart extends Model
{
	protected $table = 'sparepart';

	protected $casts = [
		'id_kategori' => 'int',
		'stok' => 'int',
		'harga_beli' => 'float',
		'harga_jual' => 'float'
	];

	protected $fillable = [
		'id_kategori',
		'nama_sparepart',
		'merek',
		'stok',
		'harga_beli',
		'harga_jual',
		'deskripsi',
		'foto'
	];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'id_kategori');
	}

	public function pengeluarans()
	{
		return $this->hasMany(Pengeluaran::class, 'id_sparepart');
	}

	public function request_spareparts()
	{
		return $this->hasMany(RequestSparepart::class, 'id_sparepart');
	}

	public function services()
	{
		return $this->belongsToMany(Service::class, 'service_sparepart', 'id_sparepart', 'id_service')
					->withPivot('id', 'jumlah', 'harga_satuan', 'subtotal')
					->withTimestamps();
	}

	public function cabangs()
	{
		return $this->belongsToMany(Cabang::class, 'sparepart_cabang', 'id_sparepart', 'id_cabang')
					->withPivot('id', 'stok')
					->withTimestamps();
	}
}
