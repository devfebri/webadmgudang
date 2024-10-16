<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instalasi extends Model
{
    use HasFactory;
    protected $table='instalasi';
    protected $fillable=['status','kode_instalasi','teknisi_id','consumen_id','item_id','nama_paket','harga_paket','deskripsi','tgl_instalasi','nomor_internet','layanan'];

    public function consumen(): BelongsTo
    {
        return $this->belongsTo(Consumen::class, 'foreign_key', 'owner_key');
    }
}
